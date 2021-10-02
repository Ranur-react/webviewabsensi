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
            $header_photo=mysqli_fetch_array($query);$query_laporan=mysqli_query($konek,"SELECT * FROM biodata_laporan");$data_laporan=mysqli_fetch_array($query_laporan);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak laporan</title>
  </head>
  <body>
    <div>
      <div style="width: 100%;">
        <table cellspacing="0"style="width: 100%;">
          <tr>
            <td style="width: 15%;"><img src="http://localhost/absensi2/img/<?PHP echo $header_photo['photo']; ?>"style="width: 100%;"></td>
              <td style="width: 70%;"align="center">
                <b>Pemerintah Kota <?PHP echo $header_photo['kota']; ?></b>
                <h2 style="margin-top:-5px;"><?PHP echo $header_photo['nama_sekolah']; ?></h2>
                  <p style="font-size: 3mm; margin-top:-20px;"><?PHP echo $header_photo['alamat']; ?>&nbsp;<?PHP echo $header_photo['kota']; ?>, Telp./Fax <?PHP echo $header_photo['telepon']; ?></p>
                  <p style="font-size: 3mm; margin-top:-20px;"><?PHP echo $header_photo['email']; ?></p>
              </td>
            <td style="width: 15%;"><img src="http://localhost/absensi2/img/tut.png"style="width: 100%;"></td>
          </tr>
        </table>
          <hr style="font-size: 3mm; margin-top:-20px;"></div>
      </div>
      <h3>Laporan rekap absen bulan <?php echo $nama_bulan[$_GET['bulan']-1]." ".$_GET['tahun']; ?></h3>
      <table cellspacing="0" style="padding: 1px; width: 100%; border: solid 2px #000000; font-size: 11pt;">
        <tr>
          <th style="width: 8%; border: solid 1px #000000;">No</th>
          <th style="width: 10%; border: solid 1px #000000;">Id Guru</th>
          <th style="width: 30%; border: solid 1px #000000;">Nama</th>
          <th style="width: 8%; border: solid 1px #000000;">L/P</th>
          <th style="width: 32%; border: solid 1px #000000;">Jumlah</th>
        </tr>
        <?php
        $no=1;
        $query_rekap=mysqli_query($konek,"SELECT * FROM guru ORDER BY nama");
        while ($data=mysqli_fetch_array($query_rekap)) {
          $query_pel_guru=mysqli_query($konek,"SELECT id_guru FROM jam_mengajar WHERE id_guru=$data[id_guru]");
          // $data_pel_guru=mysqli_fetch_array();
          if (mysqli_num_rows($query_pel_guru)==0) {
            continue;
          }else{
         ?>
        <tr><th style="width: 8%; border: solid 1px #000000;"><?php echo $no; ?></th><td style="width: 10%; border: solid 1px #000000;"><?php echo $data['id_guru']; ?></td><td style="width: 30%; border: solid 1px #000000;"><?php echo $data['nama']; ?></td><td style="width: 8%; border: solid 1px #000000;"><?php echo strtoupper($data['jenis_kelamin']); ?></td>
          <?php if($_GET['bulan']<10){ $bulan="0".$_GET['bulan']; }else{ $bulan=$_GET['bulan']; }
          $query_jml=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE tgl_ngajar like '%$_GET[tahun]-$bulan%' AND id_guru=$data[id_guru]");
          while ($data_jml=mysqli_fetch_array($query_jml)) { echo "<td style='width: 32%; border: solid 1px #000000;'>$data_jml[0] Jam</td>"; } ?> </tr> <?php $no++; } } ?>
      </table>
      <?php
      echo '<table cellspacing="0" style="width: 100%; text-align: center; font-size: 10pt">
                     <tr>
                         <td style="width: 30%">Bandung, '.date('d-m-Y').'</td>
                         <td style="width: 40%"></td>
                         <td style="width: 30%">Bandung, '.date('d-m-Y').'</td>
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
<?php
$filename="Laporan_guru_bulan_".$nama_bulan[$_GET['bulan']-1].".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
	$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
	require_once('../pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));

		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>
