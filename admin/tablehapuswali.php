<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/wali" class="tip-bottom"> Wali Kelas</a>
       <a href="#" class="current">Hapus</a> </div>
    <h1>Hapus Wali Kelas</h1>
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
                  <th colspan="2">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from guru JOIN wali_kelas ON guru.id_guru=wali_kelas.id_guru WHERE wali_kelas.id_wali=$_GET[hapus]");
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
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/proses.php?hapus_wali=<?PHP echo $data['id_wali']?>"class="btn btn-info">Ya</a></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/wali"class="btn btn-danger">Tidak</a></td>
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
