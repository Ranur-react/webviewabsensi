<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 ?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com//<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_lb span11">
          <a href="siswa">
            <i class="icon-group"></i> <strong>
              <?php $query_soswa=mysqli_query($konek,"SELECT count(id_siswa) FROM siswa");
              $data_soswa=mysqli_fetch_array($query_soswa);
              echo $data_soswa[0];
               ?>
            </strong> <small>Total Siswa</small>
          </a>
        </li>
        <li class="bg_lg span11">
          <a href="kelas">
            <i class="icon-sitemap"></i> <strong>
              <?php $query_kolas=mysqli_query($konek,"SELECT count(id_kelas) FROM kelas");
              $data_kolas=mysqli_fetch_array($query_kolas);
              echo $data_kolas[0];
               ?>
            </strong> <small>Total Kelas</small>
          </a>
        </li>
        <li class="bg_ly span11">
          <a href="guru">
            <i class="icon-group"></i> <strong>
              <?php $query_goru=mysqli_query($konek,"SELECT count(id_guru) FROM guru");
              $data_goru=mysqli_fetch_array($query_goru);
              echo $data_goru[0];
               ?>
            </strong> <small>Total Guru</small>
          </a>
        </li>
        <li class="bg_lo span11">
          <a href="wali">
            <i class="icon-user"></i> <strong>
              <?php $query_woli=mysqli_query($konek,"SELECT count(id_wali) FROM wali_kelas");
              $data_woli=mysqli_fetch_array($query_woli);
              echo $data_woli[0];
               ?>
            </strong> <small>Total Wali Kelas</small>
          </a>
         </li>
        <li class="bg_ls span11">
          <a href="admin">
            <i class="icon-user"></i> <strong>
              <?php $query_usor=mysqli_query($konek,"SELECT count(id_user) FROM user");
              $data_usor=mysqli_fetch_array($query_usor);
              echo $data_usor[0];
               ?>
            </strong> <small>Total User</small>
          </a>
        </li>
      </ul>
    </div>
<!--End-Action boxes-->
    <hr/>
    <div class="row-fluid">
      <div class="span6">
      </div>
      <div class="span6">
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->
<?php include '../layout/footer.php'; ?>
