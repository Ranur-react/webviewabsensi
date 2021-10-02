<?php
if(!isset($_SESSION['id_user'])){
//jika belum login jangan lanjut..
header("Location:https://wahyuabsensi.gunungmas-seluler.com/");
}

//cek level user
if($_SESSION['akses']!="kesiswaan" and $_SESSION['akses']!="admin"){
header("Location:https://wahyuabsensi.gunungmas-seluler.com/404.php");//jika bukan admin jangan lanjut
}
?>
