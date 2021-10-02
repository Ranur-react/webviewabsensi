<?php include '../db/koneksi.php';
include "akses.php";
//deklarasi variable absen
$keterangan_alpha=0;
$keterangan_izin=0;
$keterangan_sakit=0;
$keterangan_terlambat=0;
$nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
            'September','Oktober','November','Desember'];
            $query=mysqli_query($konek,"SELECT * FROM biodata");
            $header_photo=mysqli_fetch_array($query);
            $queryta=mysqli_query($konek,"SELECT * FROM periode where id_status='1'");
            $header_ta=mysqli_fetch_array($queryta);
            $query_laporan=mysqli_query($konek,"SELECT * FROM biodata_laporan");$data_laporan=mysqli_fetch_array($query_laporan);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak laporan</title>
  </head>
  <body>
<?php
$nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
                            'September','Oktober','November','Desember'];

?>
    <div>
      <div style="width: 100%;">
        <table cellspacing="0"style="width: 100%;">
          <tr>
            <td style="width: 15%;"><img src="https://wahyuabsensi.gunungmas-seluler.com/img/<?PHP echo $header_photo['photo']; ?>"style="width: 50%;"></td>
              <td style="width: 70%;"align="center">
                <b>Pemerintah Kota <?PHP echo $header_photo['kota']; ?></b>
                <h2 style="margin-top:-5px;"><?PHP echo $header_photo['nama_sekolah']; ?></h2>
                  <p style="font-size: 3mm; margin-top:-20px;"><?PHP echo $header_photo['alamat']; ?>&nbsp;<?PHP echo $header_photo['kota']; ?>, Telp./Fax <?PHP echo $header_photo['telepon']; ?></p>
                  <p style="font-size: 3mm; margin-top:-10px;"><?PHP echo $header_photo['email']; ?></p>
                  <p style="font-size: 3mm; margin-top:-12px;"> <?PHP echo $header_ta['tahun_ajar']." Semester ".$header_ta['semester']?><br></p>
              </td>
            <td style="width: 15%;"><img src="https://wahyuabsensi.gunungmas-seluler.com/img/tut.png"style="width: 70%;"></td>
            <tr></tr>
          </tr>
        </table>
          <hr style="font-size: 3mm; margin-top:-20px;"></div>
      </div>

      <table cellspacing="0" style="padding: 1px; width: 100%; border: solid 2px #000000; font-size: 11pt;">
        <tr>
          <th rowspan="2"style="width: 8%; border: solid 1px #000000;">No</th>
          <th style="width: 8%; border: solid 1px #000000;"rowspan="2">NIS</th>
          <th style="width: 30%; border: solid 1px #000000;"rowspan="2">Nama</th>
          <th style="width: 8%; border: solid 1px #000000;"rowspan="2">Kelas</th>
          <th style="width: 8%; border: solid 1px #000000;"rowspan="2">L/P</th>
          <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
            echo "<th style='width: 8%; border: solid 1px #000000;'rowspan='2'>$tanggal_table</th>";
          } ?>
          <th style="width: 32%; border: solid 1px #000000;"colspan="4"><p align="center">Jumlah</p></th>
          <th style="width: 8%; border: solid 1px #000000;"rowspan="2"><p align="center">Jumlah</p></th>
        </tr>
        <tr>
          <th style="width: 8%; border: solid 1px #000000;">A</th><th style="width: 8%; border: solid 1px #000000;">I</th><th style="width: 8%; border: solid 1px #000000;">S</th><th style="width: 8%; border: solid 1px #000000;">T</th>
        </tr>
        <?php
        $no=1;
        $query_rekap=mysqli_query($konek,"SELECT * FROM siswa join detail_kelas t1 on siswa.id_siswa=t1.id_siswa JOIN kelas ON t1.id_kelas=kelas.id_kelas join periode t2 on t2.id_periode=t1.id_periode WHERE t2.id_status='1' and kelas.id_kelas=$_GET[kelas] ORDER BY kelas.id_kelas");
        while ($data=mysqli_fetch_array($query_rekap)) {
          //cek bulan
          if($_GET['bulan']<10){
            $bulan="0".$_GET['bulan'];
          }else{
            $bulan=$_GET['bulan'];
          }
          $query_jml=mysqli_query($konek,"SELECT * FROM absen_siswa WHERE tgl_absen like '%$_GET[tahun]-$_GET[bulan]%' AND id_siswa=$data[id_siswa]");
          while ($data_jml=mysqli_fetch_array($query_jml)) {
            if($data_jml['keterangan']=='s'){ $keterangan_sakit++; }
            else if ($data_jml['keterangan']=='i') { $keterangan_izin++; }
            else if ($data_jml['keterangan']=='a') { $keterangan_alpha++; }
            else if ($data_jml['keterangan']=='t') { $keterangan_terlambat++; }
          }
         ?>
        <tr><th style="width: 8%; border: solid 1px #000000;"><?php echo $no; ?></th>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $data['id_siswa']; ?></td>
          <td style="width: 30%; border: solid 1px #000000;"><?php echo $data['nama']; ?></td>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $data['nama_kelas']; ?></td>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo strtoupper($data['jenis_kelamin']); ?></td>
          <?php
          $nomor2=1;
          $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_siswa t1 join jam_mengajar t2 on t1.id_jam_mengajar=t2.id_jam_mengajar join periode t3 on t3.id_periode=t2.id_periode WHERE t3.id_status='1' and
          t1.id_siswa=$data[id_siswa] and t1.tgl_absen like '%$_GET[tahun]-$_GET[bulan]%' ORDER BY t1.tgl_absen ASC;");
          while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
            //mengabil tanggal
            $ambil_tanggal=explode("-",$data_tanggal['tgl_absen']);
            //merubah menjadi tanggal jadi integer
            $ambil_tanggal[2]=(int)$ambil_tanggal[2];

            //perulangan kehadiran sesuai tanggal
            for($nomor=$nomor2;$nomor<=$ambil_tanggal[2];$nomor++){
              if($nomor==$ambil_tanggal[2]){
                  echo "<td style='width: 8%; border: solid 1px #000000;'><b>".strtoupper($data_tanggal['keterangan'])."</b></td>";
              }else {
                echo "<td style='width: 8%; border: solid 1px #000000;'></td>";
              }
            }
            //meng rekap bulannan
            $nomor2=$ambil_tanggal[2]+1;
            $sisa_td=31-$nomor2;
          }
          if(isset($sisa_td)!=true){
            $sisa_td=30;
          }
          for ($td=0; $td <= $sisa_td ; $td++) {
            echo "<td style='width: 8%; border: solid 1px #000000;'></td>";
          }
          $sisa_td=0;
           ?>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $keterangan_alpha; ?></td>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $keterangan_izin; ?></td>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $keterangan_sakit; ?></td>
          <td style="width: 8%; border: solid 1px #000000;"><?php echo $keterangan_terlambat; ?></td>
          <?php $total=$keterangan_alpha+$keterangan_sakit+$keterangan_izin; echo '<td style="width: 8%; border: solid 1px #000000;"><p align="center">'.$total.'</p></td>';?>
        </tr>
        <?php $no++;
        $keterangan_alpha=0;
        $keterangan_izin=0;
        $keterangan_sakit=0;
        $keterangan_terlambat=0;
      } ?>
      </table>
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
