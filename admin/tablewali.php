<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://absen-mtsannur.com/admin/wali" class="current">Wali Kelas</a> </div>
    <h1>Table Wali Kelas</h1>
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
                  <th>Id Wali Kelas</th>
                  <th>Nama Guru</th>
                  <th>Kelas</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>edit</th>
                  <th>Hapus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from guru JOIN wali_kelas ON guru.id_guru=wali_kelas.id_guru");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_wali']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php
                  $query_kelas=mysqli_query($konek,"SELECT nama_kelas FROM kelas WHERE id_kelas=$data[id_kelas]");
                  $data_kelas=mysqli_fetch_array($query_kelas);
                  echo $data_kelas['nama_kelas']; ?></td>
                  <td><?php echo $data['username']; ?></td>
                  <td><?php echo $data['password']; ?></td>
                  <td><a href="https://absen-mtsannur.com/admin/wali/edit/<?PHP echo $data['id_wali']?>"class="btn btn-info">Edit</a></td>
                  <td><a href="https://absen-mtsannur.com/admin/wali/hapus/<?PHP echo $data['id_wali']?>"class="btn btn-danger">Hapus</a></td>
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
