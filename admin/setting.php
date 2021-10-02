<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/setting" class="current">Setting</a> </div>
   <h1>Setting</h1>
 </div>
 <div class="container-fluid">
   <hr>
   <div class="row-fluid">
     <div class="span12">

       <div class="widget-box">
         <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <h5>Biodata</h5>
         </div>
         <div class="widget-content nopadding">
           <?php
           $query_pilih_tampil=mysqli_query($konek,"select * from biodata");
           while($data=mysqli_fetch_array($query_pilih_tampil)){
             ?>
           <form action="./proses.php?edit_biodata" method="post" class="form-horizontal"enctype="multipart/form-data">
             <div class="control-group">
               <label class="control-label">Nama Sekolah:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Sekolah"name="nama_sekolah"
                 value="<?php echo $data['nama_sekolah']; ?>" />
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
              <label for="normal" class="control-label">Nomor Telepon :</label>
              <div class="controls">
                <input type="text" id="mask-phoneExt"name="telepon" value="<?php echo $data['telepon']; ?>"class="span8 mask text">
                <span class="help-block blue span8">(999) 999-9999? x99999</span> </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kota</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Kota"name="kota"
                value="<?php echo $data['kota']; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Alamat</label>
              <div class="controls">
                <textarea class="span11" name="alamat"><?php echo $data['alamat']; ?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Upload Photo</label>
              <div class="controls">
                <ul class="thumbnails">
                  <li class="span3"> <a> <img src="../img/<?PHP echo $data['photo']; ?>" alt="" > </a>
                    <div class="actions">
                      <a class="lightbox_trigger" href="../img/<?PHP echo $data['photo']; ?>"><i class="icon-search"></i></a>
                    </div>
                  </li>
                </ul>
                <input type="file" name="photo"/>
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
