<?php
session_start();
ob_start();
$konek=mysqli_connect("localhost","gunn1374_root","Padri0@@@")or die('koneksigagal');
mysqli_select_db($konek,"gunn1374_wahyuabsensi") or die("gagal");
?>
