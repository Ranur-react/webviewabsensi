<?php
include "../db/koneksi.php";
include 'akses.php';
//proses pengabsesnan
if(isset($_GET['kategori'])){
  if($_GET['kategori']=="absen_siswa"){
      if($_POST['aksi']=="absen_baru"){
        foreach ($_POST['id_siswa'] as $id_siswa ) {
          $query_absen=mysqli_query($konek,"insert into absen_siswa(tgl_absen,keterangan,id_siswa)
          values('$_POST[tgl_absen]','$_POST[kehadiran]',$id_siswa);");
        }
      }else if($_POST['aksi']=="edit_absen"){
        foreach ($_POST['id_siswa'] as $id_siswa ) {
          $query_absen=mysqli_query($konek,"UPDATE absen_siswa SET tgl_absen = '$_POST[tgl_absen]', keterangan = '$_POST[kehadiran]'
          WHERE id_siswa = $id_siswa and tgl_absen='$_POST[tgl_absen]';");
        }
      }else {
        foreach ($_POST['id_siswa'] as $id_siswa ) {
          $query_absen=mysqli_query($konek,"DELETE FROM absen_siswa WHERE id_siswa = $id_siswa and tgl_absen='$_POST[tgl_absen]'");
        }
      }
      Header("Location:../petugas_piket/siswa");
  }else if($_GET['kategori']=="absen_guru"){
    if($_POST['aksi']=="absen_baru"){
      foreach ($_POST['id_guru'] as $id_guru ) {
        $query_absen=mysqli_query($konek,"insert into absen_guru(tgl_absen,keterangan,id_guru)
        values('$_POST[tgl_absen]','$_POST[kehadiran]',$id_guru);");
      }
    }else if($_POST['aksi']=="edit_absen"){
      foreach ($_POST['id_guru'] as $id_guru ) {
        $query_absen=mysqli_query($konek,"UPDATE absen_guru SET tgl_absen = '$_POST[tgl_absen]', keterangan = '$_POST[kehadiran]'
        WHERE id_guru = $id_guru and tgl_absen='$_POST[tgl_absen]';");
      }
    }else {
      foreach ($_POST['id_guru'] as $id_guru ) {
        $query_absen=mysqli_query($konek,"DELETE FROM absen_guru WHERE id_guru = $id_guru and tgl_absen='$_POST[tgl_absen]'");
      }
    }
    Header("Location:../petugas_piket/guru");
  }else if($_GET['kategori']=="absen_jam_ngajar"){
    if($_POST['aksi']=="absen_baru"){
      foreach ($_POST['id_jam_mengajar'] as $id_absen_jam_ngajar ) {
        $ambil=explode("_",$id_absen_jam_ngajar);
        $query_absen=mysqli_query($konek,"insert into absen_jam_ngajar(tgl_ngajar,jumlah_jam,id_jam_mengajar,id_guru)
        values('$_POST[tgl_ngajar]','$_POST[jam]',$ambil[0],$ambil[1]);");
      }
    }else if($_POST['aksi']=="edit_absen"){
      foreach ($_POST['id_jam_mengajar'] as $id_absen_jam_ngajar ) {
        $ambil=explode("_",$id_absen_jam_ngajar);
        $query_absen=mysqli_query($konek,"UPDATE absen_jam_ngajar SET tgl_ngajar = '$_POST[tgl_ngajar]', jumlah_jam = '$_POST[jam]'
        WHERE id_jam_mengajar = $ambil[0] and tgl_ngajar='$_POST[tgl_ngajar]';");
      }
    }else {
      foreach ($_POST['id_jam_mengajar'] as $id_absen_jam_ngajar ) {
        $ambil=explode("_",$id_absen_jam_ngajar);
        $query_absen=mysqli_query($konek,"DELETE FROM absen_jam_ngajar WHERE id_jam_mengajar = $ambil[0] and tgl_ngajar='$_POST[tgl_ngajar]'");
      }
    }
    Header("Location:../petugas_piket/jamngajar/");
  }
}
 ?>
