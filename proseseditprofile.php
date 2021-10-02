<?php
include "db/koneksi.php";
if(isset($_GET['edit_user'])){
  $query_edit=mysqli_query($konek,"UPDATE user SET nama='$_POST[nama]',username='$_POST[username]',
  password='$_POST[password]',email='$_POST[email]' WHERE id_user=$_SESSION[id_user]");
  $_SESSION['username']=$_POST['username'];
  Header("location:profile");
}else{
  $query_edit=mysqli_query($konek,"UPDATE wali_kelas SET username='$_POST[username]',
  password='$_POST[password]' WHERE id_wali=$_SESSION[id_user]");
  $_SESSION['username']=$_POST['username'];
  Header("location:profile");
}
 ?>
