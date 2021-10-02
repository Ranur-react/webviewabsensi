<?php
include "db/koneksi.php";
if(isset($_POST['login'])){
	$query=mysqli_query($konek,"select * from user where username='$_POST[username]' && password='$_POST[password]'");
	if(mysqli_num_rows($query)==1){
		while($user=mysqli_fetch_array($query)){
			$_SESSION['id_user']=$user['id_user'];
			$_SESSION['username']=$user['username'];
			$_SESSION['password']=$user['password'];
			$_SESSION['akses']=$user['akses'];
		}
		if($_SESSION['akses']=="admin"){
			Header("Location:admin");
		}else if($_SESSION['akses']=="petugas_piket"){
			Header("Location:petugas_piket");
		}else if($_SESSION['akses']=="kesiswaan"){
			Header("Location:kesiswaan");
		}else if($_SESSION['akses']=="koordinator"){
			Header("Location:koordinator");
		}else if($_SESSION['akses']=="siswa"){
			Header("Location:siswa");
		}else if($_SESSION['akses']=="guru"){
			Header("Location:guru");
		}
	}else {
		$query=mysqli_query($konek,"select * from wali_kelas where username='$_POST[username]' && password='$_POST[password]'");
		if(mysqli_num_rows($query)==1){
			while($user=mysqli_fetch_array($query)){
				$_SESSION['id_user']=$user['id_wali'];
				$_SESSION['username']=$user['username'];
				$_SESSION['password']=$user['password'];
				$_SESSION['akses']='wali_kelas';
				$_SESSION['id_kelas']=$user['id_kelas'];
			}
			Header("Location:wali_kelas");
		}else{
			Header("Location:../?status=error");
		}
	}
}else {
	Header("Location:../index.php");
}
?>
