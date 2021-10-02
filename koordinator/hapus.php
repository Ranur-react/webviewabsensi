<?php
include "../db/koneksi.php";
include 'akses.php';
//cek bulan
if($_GET['bulan']<10){
  $bulan="0".$_GET['bulan'];
}else{
  $bulan=$_GET['bulan'];
}
$hapus_absen=mysqli_query($konek,"DELETE FROM absen_guru WHERE tgl_absen LIKE '%$_GET[tahun]-$bulan%'");
if($hapus_absen){
  Header("Location:../koordinator/laporanabsen");
}else {
  echo "
  <script>
    alert('gagal menghapus');
  </script>
  ";
  Header("Location:../koordinator/laporanabsen");
}
?>
