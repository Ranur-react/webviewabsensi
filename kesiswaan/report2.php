<?php include '../db/koneksi.php';
include "akses.php";
//deklarasi variable absen
$alpha=0;
$izin=0;
$sakit=0;
$terlambat=0;
$nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$query=mysqli_query($konek,"SELECT * FROM biodata");
$header_photo=mysqli_fetch_array($query);
$queryta=mysqli_query($konek,"
SELECT nisn, g.nama as namag,s.nama as namas,mata_pelajaran,jam,tahun_ajar,semester FROM absen_siswa a
					JOIN siswa s ON s.id_siswa=a.id_siswa
					JOIN jam_mengajar jm ON jm.id_jam_mengajar=a.id_jam_mengajar
					JOIN pelajaran p ON p.id_pelajaran=jm.id_pelajaran
					JOIN guru g ON g.id_guru=jm.id_guru
					JOIN periode r ON r.id_periode=jm.id_periode
					WHERE MONTH(a.tgl_absen)='$_GET[bulan]' 
					AND YEAR(a.tgl_absen)='$_GET[tahun]' AND jm.id_kelas='$_GET[kelas]'
					AND s.id_siswa='$_GET[siswa]'
");
$k=mysqli_query($konek,"
SELECT nisn, g.nama as namag,s.nama as namas,mata_pelajaran,jam,
COUNT(IF(keterangan ='h',1,NULL))AS hadir,COUNT(IF(keterangan ='i',1,NULL))AS izin,COUNT(IF(keterangan ='s',1,NULL))AS sakit
,COUNT(IF(keterangan ='a',1,NULL))AS alpa FROM absen_siswa a
					JOIN siswa s ON s.id_siswa=a.id_siswa
					JOIN jam_mengajar jm ON jm.id_jam_mengajar=a.id_jam_mengajar
					JOIN pelajaran p ON p.id_pelajaran=jm.id_pelajaran
					JOIN guru g ON g.id_guru=jm.id_guru
					JOIN periode r ON r.id_periode=jm.id_periode
					WHERE MONTH(a.tgl_absen)='$_GET[bulan]' 
					AND YEAR(a.tgl_absen)='$_GET[tahun]' AND jm.id_kelas='$_GET[kelas]'
					AND s.id_siswa='$_GET[siswa]' GROUP BY mata_pelajaran
");
$header_ta=mysqli_fetch_array($queryta);
$kelas=mysqli_query($konek,"select * from kelas where id_kelas='$_GET[kelas]'");
$kelas1=mysqli_fetch_array($kelas);
$query_laporan=mysqli_query($konek,"SELECT * FROM biodata_laporan");$data_laporan=mysqli_fetch_array($query_laporan);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak laporan</title>
  </head>
  <body>
		<div style="width: 100%;">
			<table cellspacing="0"style="width: 100%;">
			  <tr>
				<td style="width: 15%;"><img src="https://absen-mtsannur.com/img/<?PHP echo $header_photo['photo']; ?>" style="width: 50%;"></td>
				  <td style="width: 70%;"align="center">
					<b>Pemerintah Kota <?PHP echo $header_photo['kota']; ?></b>
					<h2 style="margin-top:-5px;"><?PHP echo $header_photo['nama_sekolah']; ?></h2>
					  <p style="font-size: 3mm; margin-top:-20px;"><?PHP echo $header_photo['alamat']; ?>&nbsp;<?PHP echo $header_photo['kota']; ?>, Telp./Fax <?PHP echo $header_photo['telepon']; ?></p>
					  <p style="font-size: 3mm; margin-top:-10px;"><?PHP echo $header_photo['email']; ?></p>
					  <p style="font-size: 3mm; margin-top:-12px;"> <?PHP echo $header_ta['tahun_ajar']." Semester ".$header_ta['semester']?><br></p>
				  </td>
				<td style="width: 15%;"><img src="https://absen-mtsannur.com/img/TWH.jpg" style="width: 50%;"></td>
			  </tr>
			</table>
		</div>
		<hr>
		<div style="width: 100%;">
			<h3 align="center">Rekam Absensi MataPelajaran Per Siswa</h3><br>
			<table class="none">
				<tr>
					<td>NISN</td> 
					<td>: </td>
					<td><?php echo $header_ta['nisn']?></td>
				</tr>
				<tr>
					<td>Nama</td> 
					<td>: </td>
					<td><?php echo $header_ta['namas']?></td>
				</tr>
				<tr>
					<td>Kelas</td> 
					<td>: </td>
					<td><?php echo $kelas1['nama_kelas']?></td>
				</tr>
				<tr>
					<td>Bulan/Tahun</td> 
					<td>: </td>
					<td><?php echo $nama_bulan[$_GET['bulan']-1] ."/" .$_GET['tahun']?></td>
				</tr>
			</table>
		</div><br>
		<div style="overflow-x:auto;width: 100%;">
		<style>
		.table{
			border-collapse: collapse;
			width: 100%;
			text-align: left;
		}
		</style>
		<table class="table" border="1">
            <tr>
                <th>No</th>
                <th>MataPelajaran</th>
				<th>Hadir</th>
				<th>Tidak Hadir</th>
				<th>Ijin</th>
				<th>Sakit</th>
            </tr>
			<?php $no=0; 
				while ($data=mysqli_fetch_array($k))
				{$no++;?>
			<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $data['mata_pelajaran']?></td>
				<td><?php echo $data['hadir']?></td>
				<td><?php echo $data['alpa']?></td>
				<td><?php echo $data['izin']?></td>
				<td><?php echo $data['sakit']?></td>
			</tr>
			<?php }?>
		</table>
		<br><br>
		<?php
        echo '<table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt">
                     <tr>
                         <td style="width: 30%">Padang, '.date('d-m-Y').'</td>
                         <td style="width: 40%"></td>
                         <td style="width: 30%">Padang, '.date('d-m-Y').'</td>
                     </tr>
                     <tr>
                         <td style="width: 30%"><br><br><br><br>'.$data_laporan['nama_ketua'].'<br>Ketua madrasah</td>
                         <td style="width: 40%"></td>
                         <td style="width: 30%"><br><br><br><br>'.$data_laporan['nama_wakil'].'<br>Wakil Ketua Madrasah</td>
                     </tr>
                 </table>';
       ?>		
  </body>
</html>
