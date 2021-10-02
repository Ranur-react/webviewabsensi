<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>

 <div id="content">
 <div id="content-header">
   <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/guru" class="tip-bottom">Guru</a>
     <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/guru/add" class="current">Tambah</a> </div>
   <h1>Tambah Guru</h1>
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
           <form action="../proses.php?kategori=guru" method="post" class="form-horizontal">
             <div class="control-group">
               <label class="control-label">NIP :</label>
               <div class="controls">
                 <input type="number" class="span11" placeholder="NIP"name="nip" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">NUPTK :</label>
               <div class="controls">
                 <input type="number" class="span11" placeholder="NUPTK"name="nuptk" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Name Lengkap:</label>
               <div class="controls">
                 <input type="text" class="span11" placeholder="Nama Lengkap"name="nama" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Jenis Kelamin</label>
               <div class="controls">
                <label>
                  <input type="radio" name="jenis_kelamin"value="l" required />
                  Laki - Laki</label>
                <label>
                  <input type="radio" name="jenis_kelamin"value="p" required />
                  Perempuan</label>
              </div>
             </div>
             <div class="control-group">
              <label class="control-label">Tanggal Lahir (mm-dd)</label>
              <div class="controls">
                  <input type="date"name="tgl_lahir"class="span11" required >
              </div>
            </div>
             <div class="control-group">
               <label class="control-label">Jabatan :</label>
               <div class="controls">
                 <input type="text" class="span11"name="jabatan" placeholder="Jabatan" required />
               </div>
             </div>
             <div class="control-group">
               <label class="control-label">Status :</label>
               <div class="controls">
                 <select  name="status">
                   <option value="pns">PNS</option>
                   <option value="gty">GTY</option>
                   <option value="gtt">GTT</option>
                 </select>
               </div>
             </div>
             <div class="control-group">
              <label for="normal" class="control-label">Nomor Telepon :</label>
              <div class="controls">
                <input type="text" id="mask-phoneExt"name="telepon" class="span8 mask text"required >
                <span class="help-block blue span8">(999) 999-9999? x99999</span> </div>
            </div>
             <div class="control-group">
               <label class="control-label">Alamat</label>
               <div class="controls">
                 <textarea class="span11" name="alamat"></textarea>
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
