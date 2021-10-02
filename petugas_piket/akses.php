<?php
if(!isset($_SESSION['id_user'])){
//jika belum login jangan lanjut..
header("Location:http://localhost/absensi2/");
}

//cek level user
if($_SESSION['akses']!="petugas_piket" and $_SESSION['akses']!="admin"){
header("Location:http://localhost/absensi2/404.php");//jika bukan admin jangan lanjut
}
?>
