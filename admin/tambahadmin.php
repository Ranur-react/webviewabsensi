<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/admin" class="tip-bottom">Admin</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/add" class="current">Tambah</a> </div>
   <h1>Tambah Admin</h1>
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
           <form action="../proses.php?kategori=admin" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Nama Lengkap:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Lengkap"name="nama" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Username: </label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Username"name="username" required />
                 <br><i>Isi dengan nip untuk guru atau nis untuk siswa</i>
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Password:</label>
               <div class="controls">
                 <input type="password" class="span11" placeholder="Password"name="password" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Email:</label>
               <div class="controls">
                 <input type="email" class="span11" placeholder="Email"name="email" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Hak Akses:</label>
               <div class="controls">
                 <select  name="akses">
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
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

 <?php include '../layout/footer.php'; ?>
