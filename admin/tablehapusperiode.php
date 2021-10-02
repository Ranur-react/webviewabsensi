<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://absen-mtsannur.com/admin/kelas" class="tip-bottom"> Kelas</a>
       <a href="#" class="current">Hapus</a> </div>
    <h1>Hapus Kelas</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Periode</th>
                  <th>Tahun Ajar</th>
                  <th>Semester</th>
                  <th colspan="2">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from periode where id_periode=$_GET[hapus]");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_periode']; ?></td>
                  <td><?php echo $data['tahun_ajar']; ?></td>
                  <td><?php echo $data['semester']; ?></td>
                  <td><a href="https://absen-mtsannur.com/admin/proses.php?hapus_periode=<?PHP echo $data['id_periode']?>"class="btn btn-info">Ya</a></td>
                  <td><a href="https://absen-mtsannur.com/admin/kelas/"class="btn btn-danger">Tidak</a></td>
                </tr>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->
<?php include '../layout/footer.php'; ?>