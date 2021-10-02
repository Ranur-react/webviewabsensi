<?php
include "../db/koneksi.php";
include 'akses.php';
//block daftar
if(isset($_GET['kategori'])){
  if($_GET['kategori']=="siswa"){
    $query_daftar=mysqli_query($konek,"INSERT INTO siswa (nisn, nama, jenis_kelamin, alamat, tgl_lahir, telepon) VALUES
    ('$_POST[nisn]','$_POST[nama]','$_POST[jenis_kelamin]','$_POST[alamat]', '$_POST[tgl_lahir]', '$_POST[telepon]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/siswa">
        <?php
        // Header("location:../admin/siswa");
      }else{
        Header("location:siswa/add");
      }

  }else if($_GET['kategori']=="periode"){
    $query_daftar=mysqli_query($konek,"INSERT INTO periode (tahun_ajar, semester, id_status) VALUES
    ('$_POST[tahun_ajar]','$_POST[semester]','1');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/periode">
        <?php
        //Header("location:../admin/periode");
      }else{
        Header("location:periode/add");
      }
  }else if($_GET['kategori']=="pembagian_kelas"){
    if($_GET['hapus']){
      $query_hapus_absen=mysqli_query($konek,"DELETE FROM detail_kelas WHERE id_detail_siswa=$_GET[hapus]");

  Header("location:../admin/pembagian_kelas");

    }else{
      foreach ($_POST['id_siswa'] as $id_siswa ) {
        $query_detail_kelas=mysqli_query($konek,"insert into detail_kelas(id_periode,id_kelas,id_siswa)
        values('$_POST[id_periode]','$_POST[id_kelas]',$id_siswa);");
      } 
      if($query_detail_kelas){
        ?>
        <script>alert("Data Berhasil disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/pembagian_kelas">
        <?php
        //Header("location:../admin/pembagian_kelas");
      }else{
        Header("location:pembagian_kelas/add");
      }

    }

  }else if($_GET['kategori']=="guru"){
    $query_daftar=mysqli_query($konek,"INSERT INTO guru (nip,nuptk,status,nama, jenis_kelamin, alamat, jabatan, telepon,tgl_lahir) VALUES
    ('$_POST[nip]','$_POST[nuptk]','$_POST[status]','$_POST[nama]','$_POST[jenis_kelamin]','$_POST[alamat]', '$_POST[jabatan]' , '$_POST[telepon]','$_POST[tgl_lahir]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/guru">
        <?php
        //Header("location:../admin/guru");
      }else{
        Header("location:guru/add");
      }
  }else if($_GET['kategori']=="admin"){
    $query_daftar=mysqli_query($konek,"INSERT INTO user (username, password, nama, email, akses) VALUES
    ('$_POST[username]','$_POST[password]', '$_POST[nama]' , '$_POST[email]','$_POST[akses]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/admin">
        <?php
        //Header("location:../admin/admin");
      }else{
        Header("location:admin/add");
      }
  }else if($_GET['kategori']=="kelas"){
    $query_daftar=mysqli_query($konek,"INSERT INTO kelas (nama_kelas) VALUES ('$_POST[nama_kelas]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/kelas">
        <?php
        //Header("location:../admin/kelas/");
      }else{
        Header("location:kelas/add/");
      }
  }else if($_GET['kategori']=="wali"){
    $query_daftar=mysqli_query($konek,"INSERT INTO wali_kelas (username,password,id_guru,id_kelas)
    VALUES ('$_POST[username]','$_POST[password]','$_POST[id_guru]','$_POST[id_kelas]');");
      if($query_daftar){
        Header("location:../admin/wali/");
      }else{
        Header("location:wali/add/");
      }
  }else if($_GET['kategori']=="pelajaran"){
    $query_daftar=mysqli_query($konek,"INSERT INTO pelajaran (mata_pelajaran) VALUES ('$_POST[mata_pelajaran]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/pelajaran">
        <?php
        //Header("location:../admin/pelajaran/");
      }else{
        Header("location:pelajaran/add/");
      }
  }else if($_GET['kategori']=="jamngajar"){
    $query_daftar=mysqli_query($konek,"INSERT INTO jam_mengajar (jam,id_guru,id_pelajaran,id_kelas,id_periode)
    VALUES ('$_POST[jamngajar]','$_POST[id_guru]','$_POST[id_pelajaran]','$_POST[id_kelas]','$_POST[id_periode]');");
      if($query_daftar){
        ?>
        <script>alert("Data Berhasil Disimpan");</script>
        <meta http-equiv="refresh" content="0;url=../admin/jamngajar">
        <?php
        //Header("location:../admin/jamngajar/");
      }else{
        Header("location:jamngajar/add/");
      }
  }
}

//blockhapus
if(isset($_GET['hapus_siswa'])){
  $query_hapus_absen=mysqli_query($konek,"DELETE FROM absen_siswa WHERE id_siswa=$_GET[hapus_siswa]");
  $query_hapus=mysqli_query($konek,"DELETE FROM siswa WHERE id_siswa = $_GET[hapus_siswa]");
  ?>
        <script>alert("Data Berhasil Dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/siswa">
        <?php
  //Header("location:../admin/siswa");
}else if(isset($_GET['hapus_guru'])){
  $query_hapus_absen=mysqli_query($konek,"DELETE FROM absen_guru WHERE id_guru=$_GET[hapus_guru]");
  $query_hapus=mysqli_query($konek,"DELETE FROM guru WHERE id_guru = $_GET[hapus_guru]");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/guru">
        <?php
  //Header("location:../admin/guru");
}else if(isset($_GET['hapus_admin'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM user WHERE id_user = $_GET[hapus_admin]");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/admin">
        <?php
  //Header("location:../admin/admin");
}else if(isset($_GET['hapus_kelas'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM kelas WHERE id_kelas = $_GET[hapus_kelas]");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/kelas">
        <?php
  //Header("location:../admin/kelas");
}else if(isset($_GET['hapus_wali'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM wali_kelas WHERE id_wali = $_GET[hapus_wali]");
  Header("location:../admin/wali");
}else if(isset($_GET['hapus_pelajaran'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM pelajaran WHERE id_pelajaran = $_GET[hapus_pelajaran]");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/pelajaran">
        <?php
  //Header("location:../admin/pelajaran");
}else if(isset($_GET['hapus_jamngajar'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM jam_mengajar WHERE id_jam_mengajar = $_GET[hapus_jamngajar]");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/jamngajar">
        <?php
  //Header("location:../admin/jamngajar");
}else if(isset($_GET['hapus_hadir'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM kehadiran_guru WHERE id = $_GET[hapus_hadir]");
  Header("location:../petugas_piket/hadir");
}else if(isset($_GET['hapus_detail'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM detail_absen WHERE id_detail_kelas = '$_GET[hapus_detail]'");
  Header("location:../admin/pembagian_kelas_list");
}else if(isset($_GET['hapus_detail_kelas'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM detail_kelas WHERE id_detail_kelas = '$_GET[hapus_detail_kelas]'");
  Header("location:../admin/pembagian_kelas_list");
}else if(isset($_GET['hapus_periode'])){
  $query_hapus=mysqli_query($konek,"DELETE FROM periode WHERE id_periode = '$_GET[hapus_periode]'");
  ?>
        <script>alert("Data Berhasil dihapus");</script>
        <meta http-equiv="refresh" content="0;url=../admin/periode">
        <?php
  //Header("location:../admin/periode");
}

//blockedit
if(isset($_GET['edit_siswa'])){
  $query_edit=mysqli_query($konek,"UPDATE siswa SET nisn='$_POST[nisn]', nama='$_POST[nama]',jenis_kelamin='$_POST[jenis_kelamin]', alamat='$_POST[alamat]',
  tgl_lahir='$_POST[tgl_lahir]',telepon='$_POST[telepon]' WHERE id_siswa=$_GET[edit_siswa]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/siswa">
        <?php
  //Header("location:../admin/siswa");
}else if(isset($_GET['edit_jamngajar'])){
  $query_edit=mysqli_query($konek,"UPDATE jam_mengajar SET id_periode='$_POST[id_periode]',jam='$_POST[jamngajar]',id_pelajaran='$_POST[id_pelajaran]',id_guru='$_POST[id_guru]',
  id_kelas='$_POST[id_kelas]' WHERE id_jam_mengajar=$_GET[edit_jamngajar]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/jamngajar">
        <?php
  //Header("location:../admin/jamngajar");
}else if(isset($_GET['edit_guru'])){
  $query_edit=mysqli_query($konek,"UPDATE guru SET status='$_POST[status]',nip='$_POST[nip]',nuptk='$_POST[nuptk]',nama='$_POST[nama]',jenis_kelamin='$_POST[jenis_kelamin]',
  tgl_lahir='$_POST[tgl_lahir]',alamat='$_POST[alamat]',
  jabatan='$_POST[jabatan]',telepon='$_POST[telepon]' WHERE id_guru=$_GET[edit_guru]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/guru">
        <?php
  //Header("location:../admin/guru");
}else if(isset($_GET['edit_user'])){
  $query_edit=mysqli_query($konek,"UPDATE user SET nama='$_POST[nama]',username='$_POST[username]',
  password='$_POST[password]',email='$_POST[email]',
  akses='$_POST[akses]' WHERE id_user=$_GET[edit_user]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/admin">
        <?php
  //Header("location:../admin/admin");
}else if(isset($_GET['edit_kelas'])){
  $query_edit=mysqli_query($konek,"UPDATE kelas SET nama_kelas='$_POST[nama_kelas]' WHERE id_kelas=$_GET[edit_kelas]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/kelas">
        <?php
  //Header("location:../admin/kelas");
}else if(isset($_GET['edit_pelajaran'])){
  $query_edit=mysqli_query($konek,"UPDATE pelajaran SET mata_pelajaran='$_POST[mata_pelajaran]' WHERE id_pelajaran=$_GET[edit_pelajaran]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/pelajaran">
        <?php
  //Header("location:../admin/pelajaran");
}else if(isset($_GET['edit_periode'])){
  $query_edit=mysqli_query($konek,"UPDATE periode SET tahun_ajar='$_POST[tahun_ajar]',semester='$_POST[semester]',id_status='$_POST[id_status]' WHERE id_periode=$_GET[edit_periode]");
  ?>
        <script>alert("Data Berhasil diedit");</script>
        <meta http-equiv="refresh" content="0;url=../admin/periode">
        <?php
  //Header("location:../admin/periode");
}else if(isset($_GET['edit_wali'])){
  $query_edit=mysqli_query($konek,"UPDATE wali_kelas SET username='$_POST[username]',password='$_POST[password]',
    id_guru=$_POST[id_guru],id_kelas=$_POST[id_kelas] WHERE id_wali=$_GET[edit_wali]");
  Header("location:../admin/wali");
}else if(isset($_GET['edit_biodata'])){
  $waktu=time();
 $nama=$_FILES['photo']['name'];
 $type=$_FILES['photo']['type'];
 $asal=$_FILES['photo']['tmp_name'];
 $error=$_FILES['photo']['error'];
 $ukuran=$_FILES['photo']['size'];
 $titikarray=explode(".",$nama);
 $typefile=end($titikarray);
 //validasi type file dan ukurang
 if ($error>0) {
	 $query_tambah=mysqli_query($konek,"UPDATE biodata SET nama_sekolah = '$_POST[nama_sekolah]',
                                                          kota = '$_POST[kota]',
                                                           alamat = '$_POST[alamat]',
                                                           email = '$_POST[email]',
                                                           telepon = '$_POST[telepon]' WHERE id_biodata = 1;");
                                                           Header("location:../admin/wali");
 }
 $validtype = array("image/jpeg", "image/jpg", "image/png");
 if((in_array($type,$validtype)) && ($ukuran < 1000000) ){
  if ($error > 0) {
		echo "error";
  }else{//validasi nama sama
   if(file_exists("../img/".$nama)){
    $nama=str_replace($typefile,$waktu.".".$typefile,$nama);
   }
   $query_ambil=mysqli_query($konek,"SELECT photo FROM biodata");
   $data_photo=mysqli_fetch_array($query_ambil);
   $photo="../img/".$data_photo['photo'];
   unlink($photo);
	 $photo="../img/".$nama;
   move_uploaded_file($asal,$photo);
		$query_tambah=mysqli_query($konek,"UPDATE biodata SET nama_sekolah = '$_POST[nama_sekolah]',
                                                            kota = '$_POST[kota]',
                                                            alamat = '$_POST[alamat]',
                                                            photo = '$nama',
                                                            email = '$_POST[email]',
                                                            telepon = '$_POST[telepon]' WHERE id_biodata = 1;");
  }
 }
  Header("location:../admin/setting");
}else if(isset($_GET['edit_laporan'])){
  $query_edit=mysqli_query($konek,"UPDATE biodata_laporan SET nama_ketua = '$_POST[nama_ketua]', nama_wakil = '$_POST[nama_wakil]' WHERE id = 1;");
  Header("location:../admin/settinglaporan");
}
 ?>
