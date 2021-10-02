<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/wali" class="tip-bottom">Wali Kelas</a>
    <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/wali/add" class="current">Tambah</a> </div>
   <h1>Tambah Wali Kelas</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Tambah Wali Kelas</h5>
         </div>
         <div class="widget-content nopadding">
           <form action="../proses.php?kategori=wali" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Pilih Wali Kelas :</label>
               <div class="controls">
                 <select name="id_guru">
                   <?php
                   $query=mysqli_query($konek,"SELECT * FROM guru");
                   while ($data=mysqli_fetch_array($query)) {
                     echo "<option value='$data[id_guru]'>$data[nama]</option>";
                   }
                   ?>
                 </select>
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Pilih Kelas :</label>
               <div class="controls">
                 <select name="id_kelas">
                   <?php
                   $query=mysqli_query($konek,"SELECT * FROM kelas");
                   while ($data=mysqli_fetch_array($query)) {
                     echo "<option value='$data[id_kelas]'>$data[nama_kelas]</option>";
                   }
                   ?>
                 </select>
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Username :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Username"name="username" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Password :</label>
               <div class="controls">
                 <input type="password" class="span11" placeholder="Password"name="password" />
               </div>
             </div>
             <div class="form-actions">
               <button type="submit" class="btn btn-success">Save</button>
               <button type="reset" class="btn btn-warning">Reset</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

 <?php include '../layout/footer.php'; ?>
