<?php
if(!isset($_SESSION['id_user'])){
//jika belum login jangan lanjut..
header("Location:https://wahyuabsensi.gunungmas-seluler.com/");
}

//cek level user
if($_SESSION['akses']!="guru"){
header("Location:https://wahyuabsensi.gunungmas-seluler.com/404.php");//jika bukan admin jangan lanjut
}
?>
