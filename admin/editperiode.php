<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://absen-mtsannur.com/admin/kelas" class="tip-bottom">Kelas</a> <a href="#" class="current">Edit</a> </div>
   <h1>Edit Kelas</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Edit Periode</h5>
         </div>
         <div class="widget-content nopadding">
           <?php
           $query_pilih_tampil=mysqli_query($konek,"select * from periode where id_periode=$_GET[edit]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="../../proses.php?edit_periode=<?php echo $_GET['edit']; ?>" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">Tahun Ajar :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Tahun Ajar"name="tahun_ajar"
                 value="<?php echo $data['tahun_ajar']; ?>" />
               </div>
             </div>

             <div class="control-group">
               <label class="control-label">Semester :</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Semester"name="semester"
                 value="<?php echo $data['semester']; ?>" />
               </div>
             </div>

             <div class="control-group">
               <label class="control-label">Status :</label>
               <div class="controls">
                 <select name="id_status">
                   <option value=''>Pilih</option>
                   <option value='1' <?php if($data['id_status']=="1"){ echo "selected"; } ?>>Aktif</option>
                   <option value='2'  <?php if($data['id_status']=="2"){ echo "selected";} ?>>Tidak Aktif</option>
                   
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
