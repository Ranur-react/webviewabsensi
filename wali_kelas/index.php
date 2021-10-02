<?php
  include '../db/koneksi.php';
  include 'akses.php';
  include '../layout/header.php';
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" class="current">Dashboard</a></div>
    <h1>Dashboard</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5>Statistic Ketidak Masukan Siswa Selama 1 Minggu Terakhir</h5>
          </div>
          <div class="widget-content">
            <div id="placeholder"></div>
            <p id="choices"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../layout/footer.php'; ?>
