<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://absen-mtsannur.com/admin/wali" class="tip-bottom">Wali Kelas</a> <a href="#" class="current">Edit</a> </div>
   <h1>Edit Wali Kelas</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Edit Kelas</h5>
         </div>
         <div class="widget-content nopadding">
           <?php
           $query_pilih_tampil=mysqli_query($konek,"select * from guru JOIN wali_kelas ON wali_kelas.id_guru=guru.id_guru where wali_kelas.id_wali=$_GET[edit]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="../../proses.php?edit_wali=<?php echo $_GET['edit']; ?>" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Pilih Wali Kelas :</label>
               <div class="controls">
                 <select name="id_guru">
                    <option value="<?PHP echo $data['id_guru']?>"><?PHP echo $data['nama']; ?></option>
                   <?php
                   $query=mysqli_query($konek,"SELECT * FROM guru");
                   while ($data2=mysqli_fetch_array($query)) {
                     echo "<option value='$data2[id_guru]'>$data2[nama]</option>";
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
                   $query=mysqli_query($konek,"SELECT * FROM kelas WHERE id_kelas=$data[id_kelas]");
                   $data3=mysqli_fetch_array($query);
                   ?>
                   <option value="<?PHP echo $data3['id_kelas']?>"><?PHP echo $data3['nama_kelas']; ?></option>
                   <?PHP
                   $query=mysqli_query($konek,"SELECT * FROM kelas");
                   while ($data4=mysqli_fetch_array($query)) {
                     echo "<option value='$data4[id_kelas]'>$data4[nama_kelas]</option>";
                   }
                   ?>
                 </select>
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Username :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Username"name="username"value="<?PHP echo $data['username']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Password :</label>
               <div class="controls">
                 <input type="password" class="span11" placeholder="Password"name="password" value="<?PHP echo $data['password']; ?>"/>
                 <?PHP echo $data['password']; ?>
               </div>
             </div>
             <div class="form-actions">
               <button type="submit" class="btn btn-success">Save</button>
               <button type="reset" class="btn btn-warning">Reset</button>
             </div>
           </form>
           <?php } ?>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

 <?php include '../layout/footer.php'; ?>
