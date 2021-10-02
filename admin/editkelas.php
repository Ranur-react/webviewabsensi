<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/kelas" class="tip-bottom">Kelas</a> <a href="#" class="current">Edit</a> </div>
   <h1>Edit Kelas</h1>
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
           $query_pilih_tampil=mysqli_query($konek,"select * from kelas where id_kelas=$_GET[edit]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="../../proses.php?edit_kelas=<?php echo $_GET['edit']; ?>" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Nama Kelas :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Kelas"name="nama_kelas"
                 value="<?php echo $data['nama_kelas']; ?>" />
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
