<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://web.absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/"
    title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://web.absen-mtsannur.com/admin/admin" class="tip-bottom">admin</a> <a href="#" class="current">Edit</a> </div>
   <h1>Edit Admin</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Personal-info</h5>
         </div>
         <div class="widget-content nopadding">
           <?php
           $query_pilih_tampil=mysqli_query($konek,"select * from user where id_user=$_GET[edit]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="../../proses.php?edit_user=<?php echo $_GET['edit']; ?>" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Name Lengkap:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Lengkap"name="nama"
                 value="<?php echo $data['nama']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Username:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Username"name="username"
                 value="<?php echo $data['username']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Password:</label>
               <div class="controls">
                 <input type="password" class="span11" placeholder="Password"name="password"
                 value="<?php echo $data['password']; ?>" /><?php echo $data['password']; ?>
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Email:</label>
               <div class="controls">
                 <input type="email" class="span11" placeholder="Email"name="email"
                 value="<?php echo $data['email']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Hak Akses:</label>
               <div class="controls">
                 <select  name="akses">
                   <option value="<?PHP echo $data['akses']; ?>"><?PHP echo $data['akses']; ?></option>
                   <option value="admin">Admin</option>
                   <option value="guru">Guru</option>
                   <option value="siswa">Siswa</option>
                 </select>
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
