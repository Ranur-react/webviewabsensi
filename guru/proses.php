<?php
include "../db/koneksi.php";
include 'akses.php';
//proses pengabsesnan
if(isset($_GET['kategori'])){
  if($_GET['kategori']=="absen_ngajar"){
    $query_panggil=mysqli_query($konek,"select * from guru where nip='$_SESSION[username]'");
    $cenquery=mysqli_fetch_array($query_panggil);
      if($_POST['aksi']=="absen_baru"){
        
        $query_absen=mysqli_query($konek,"insert into absen_jam_ngajar(tgl_ngajar,jam_mulai,jam_selesai,id_jam_mengajar,id_guru)
          values('$_POST[tgl_ngajar]','$_POST[jam_mulai]','$_POST[jam_selesai]','$_POST[id_jam_mengajar]','$cenquery[id_guru]');");
        
      }else if($_POST['aksi']=="edit_absen"){
          $query_absen=mysqli_query($konek,"UPDATE absen_jam_ngajar SET tgl_ngajar = '$_POST[tgl_ngajar]', jam_mulai = '$_POST[jam_mulai]', jam_selesai = '$_POST[jam_selesai]', id_jam_mengajar = '$_POST[id_jam_mengajar]'
          WHERE tgl_ngajar='$_POST[tgl_ngajar]' and id_guru='$cenquery[id_guru]';");
        
      }else {
          $query_absen=mysqli_query($konek,"DELETE FROM absen_jam_ngajar WHERE id_guru = '$cenquery[id_guru]' and tgl_ngajar='$_POST[tgl_ngajar]'");
        
      }
      Header("Location:../guru/absenjamngajar");
  }else if($_GET['kategori']=="simpan_ambil_absen"){

    $tgl_absen=date('Y-m-d');
     foreach ($_POST['id_siswa'] as $id_siswa ) {
        
     $query_absen=mysqli_query($konek,"insert into absen_siswa(tgl_absen,keterangan,id_siswa,id_jam_mengajar,id_status)
          values('$tgl_absen','$_POST[keterangan]','$id_siswa','$_POST[id_jam_mengajar]','2');");

      } 
    
    Header("Location:../guru/absenjamngajar");
  }else if($_GET['kategori']=="absen_ngajar_approve"){
     $query_absen=mysqli_query($konek,"UPDATE absen_siswa SET id_status = '2' WHERE id_absen_siswa ='$_GET[id_absen_siswa]';");
    
    Header("Location:../guru/siswa");
  }else if($_GET['kategori']=="batal_absen_ngajar_approve"){
    $query_absen=mysqli_query($konek,"UPDATE absen_siswa SET id_status = '1' WHERE id_absen_siswa ='$_GET[id_absen_siswa]';");
   
   Header("Location:../guru/siswa");
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
    Header("Location:../guru/jamngajar/");
  }
}
 ?>
