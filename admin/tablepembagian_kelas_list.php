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
                  <th>No</th>
                  <th>Id Kelas</th>
                  <th>Kelas</th>
                  <th>Nis</th>
                  <th>Nama Siswa</th>
                  <th>Tahun Ajar</th>
                  <th>Semester</th>
                  <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from kelas t1 join detail_kelas t2 on t1.id_kelas=t2.id_kelas join siswa t3 on t3.id_siswa=t2.id_siswa join periode t4 on t2.id_periode=t4.id_periode ORDER BY t4.id_periode desc");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_kelas']; ?></td>
                  <td><?php echo $data['nama_kelas']; ?></td>
                  <td><?php echo $data['nisn']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['tahun_ajar']; ?></td>
                  <td><?php echo $data['semester']; ?></td>
                  <td><a href="https://absen-mtsannur.com/admin/proses.php?hapus_detail_kelas=<?PHP echo $data['id_detail_kelas']?>"class="btn btn-danger">HAPUS</a></td>
                  
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
