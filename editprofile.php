<?php
 include 'db/koneksi.php';
 include 'layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="#" class="current">profile</a></div>
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
           if ($_SESSION['akses']=="wali_kelas") {
             $query_pilih_tampil=mysqli_query($konek,"select * from wali_kelas where id_wali=$_SESSION[id_user]");
             while($data=mysqli_fetch_array($query_pilih_tampil)){
               ?>
             <form action="./proseseditprofile.php?edit_wali" method="post" class="form-horizontal">
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
               <div class="form-actions">
                 <button type="submit" class="btn btn-success">Save</button>
                  <button type="reset" class="btn btn-warning">Reset</button>
               </div>
             </form>
           <?PHP  } }else{
           $query_pilih_tampil=mysqli_query($konek,"select * from user where id_user=$_SESSION[id_user]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="./proseseditprofile.php?edit_user" method="post" class="form-horizontal">
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
             <div class="form-actions">
               <button type="submit" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-warning">Reset</button>
             </div>
           </form>
           <?php
         }//end while
       }//end if ?>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

 <?php include 'layout/footer.php'; ?>
