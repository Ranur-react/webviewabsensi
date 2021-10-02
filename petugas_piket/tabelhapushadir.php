<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="http://localhost/absensi2/admin/admin" class="tip-bottom"> Admin</a>
      <a href="#" class="current">Hapus</a> </div>
    <h1>Hapus Admin</h1>
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
                  <th>NIP</th>
                  <th>nama</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  
                  <th colspan="2">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from kehadiran_guru where id=$_GET[hapus]");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nip']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['tanggal']; ?></td>
                  <td><?php echo $data['jam']; ?></td>
                 
                  <td><a href="http://localhost/absensi2/admin/proses.php?hapus_hadir=<?PHP echo $data['id']?>"class="btn btn-info">Ya</a></td>
                  <td><a href="http://localhost/absensi2/petugas_piket/hadir/"class="btn btn-danger">Tidak</a></td>
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
