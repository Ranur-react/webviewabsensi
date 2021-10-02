<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/pelajaran" class="current">Pelajaran</a> </div>
    <h1>Table Pelajaran</h1>
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
                  <th>no</th>
                  <th>Id Pelajaran</th>
                  <th>Pelajaran</th>
                  <th>edit</th>
                  <th>Hapus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from pelajaran ORDER BY mata_pelajaran");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_pelajaran']; ?></td>
                  <td><?php echo $data['mata_pelajaran']; ?></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/pelajaran/edit/<?PHP echo $data['id_pelajaran']?>"class="btn btn-info">Edit</a></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/pelajaran/hapus/<?PHP echo $data['id_pelajaran']?>"class="btn btn-danger">Hapus</a></td>
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
