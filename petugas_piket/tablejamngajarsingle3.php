<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 ?>
 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="http://localhost/absensi2/petugas_piket/jamngajar" class="current">Jam Ngajar</a> </div>
     <h1>Jam Mengajar</h1>
   </div>
   <div class="container">
     <div class="span11">
     <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            Guru
            </div>
            <div class="widget-content">
              <table class="">
                <th>NO</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
                  echo "<th rowspan='2'>$tanggal_table</th>";
                } ?>
                <th>Jumlah Perbulan</th>
              </table>
            </div>
          </div>
        </div>
      </div>
 </div>
 <?php include '../layout/footer.php'; ?>
