<?php
if(!isset($_SESSION['id_user'])){
//jika belum login jangan lanjut..
header("Location:https://absen-mtsannur.com/");
}

//cek level user
if($_SESSION['akses']!="guru"){
header("Location:https://absen-mtsannur.com/404.php");//jika bukan admin jangan lanjut
}
?>
