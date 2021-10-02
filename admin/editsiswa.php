<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/siswa" class="tip-bottom">siswa</a> <a href="#" class="current">Edit</a> </div>
   <h1>Edit Siswa</h1>
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
           $query_pilih_tampil=mysqli_query($konek,"select * from siswa where id_siswa=$_GET[edit]");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="../../proses.php?edit_siswa=<?php echo $_GET['edit']; ?>" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">NISN:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nisn" name="nisn"
                 value="<?php echo $data['nisn']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Name Lengkap:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Lengkap"name="nama"
                 value="<?php echo $data['nama']; ?>" />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Jenis Kelamin</label>
               <?php if ($data['jenis_kelamin']=="p") {
                 $cheked_laki="";
                 $cheked_perempuan="checked";
               }else {
                 $cheked_laki="checked";
                 $cheked_perempuan="";
               } ?>
               <div class="controls">
                <label>
                  <input type="radio" name="jenis_kelamin"value="l" <?php echo $cheked_laki; ?>/>
                  Laki - Laki</label>
                <label>
                  <input type="radio" name="jenis_kelamin"value="p" <?php echo $cheked_perempuan; ?>/>
                  Perempuan</label>
              </div>
             </div>
             <div class="control-group">
              <label class="control-label">Tanggal Lahir (mm-dd)</label>
              <div class="controls">
                  <input type="date"name="tgl_lahir"class="span11"value="<?php echo $data['tgl_lahir']; ?>" >
              </div>
            </div>
             
             <div class="control-group">
              <label for="normal" class="control-label">Nomor Telepon :</label>
              <div class="controls">
                <input type="text" id="mask-phoneExt"name="telepon" value="<?php echo $data['telepon']; ?>"class="span8 mask text">
                <span class="help-block blue span8">(999) 999-9999? x99999</span> </div>
            </div>
             <div class="control-group">
               <label class="control-label">Alamat</label>
               <div class="controls">
                 <textarea class="span11" name="alamat"><?php echo $data['alamat']; ?></textarea>
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
