<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="#" class="tip-bottom">Kelas</a> <a href="#" class="current">Tambah</a> </div>
   <h1>Tambah Kelas</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Tambah Kelas</h5>
         </div>
         <div class="widget-content nopadding">
           <form action="../proses.php?kategori=periode" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Tahun Ajar :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Tahun Ajar"name="tahun_ajar" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Semester :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Semester"name="semester" required />
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