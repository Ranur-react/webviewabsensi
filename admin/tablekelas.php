<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://absen-mtsannur.com/admin/kelas" class="current">Kelas</a> </div>
    <h1>Table Kelas</h1>
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
                  <th>Id Kelas</th>
                  <th>Kelas</th>
                  <th>edit</th>
                  <th>Hapus</th>
                  <th>detail</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from kelas ORDER BY nama_kelas");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_kelas']; ?></td>
                  <td><?php echo $data['nama_kelas']; ?></td>
                  <td><a href="https://absen-mtsannur.com/admin/kelas/edit/<?PHP echo $data['id_kelas']?>"class="btn btn-info">Edit</a></td>
                  <td><a href="https://absen-mtsannur.com/admin/kelas/hapus/<?PHP echo $data['id_kelas']?>"class="btn btn-danger">Hapus</a></td>
                  <td><a href="https://absen-mtsannur.com/admin/siswa?detail=<?PHP echo $data['id_kelas']?>"class="btn btn-info">
                  Detail</a></td>
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
