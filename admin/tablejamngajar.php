<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://absen-mtsannur.com/admin/jamngaja" class="current">Jam Ngajar</a> </div>
    <h1>Table Jam Ngajar</h1>
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
                  <th>Id Jam Ngaja</th>
                  <th>Nama Guru</th>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Jumlah Jam</th>
                  <th>Tahun Ajar</th>
                  <th>Semester</th>
                  <th>edit</th>
                  <th>Hapus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from jam_mengajar t1 join periode t2 on t1.id_periode=t2.id_periode where t2.id_status='1'");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_jam_mengajar']; ?></td>
                  <td><?php
                  $query_tampil2=mysqli_query($konek,"select nama from guru WHERE id_guru=$data[id_guru]");
                  $data2=mysqli_fetch_array($query_tampil2);
                  echo $data2['nama']; ?></td>
                  <td><?php
                  $query_kelas=mysqli_query($konek,"SELECT nama_kelas FROM kelas WHERE id_kelas=$data[id_kelas]");
                  $data_kelas=mysqli_fetch_array($query_kelas);
                  echo $data_kelas['nama_kelas']; ?></td>
                  <td><?php
                      $query_pelajaran=mysqli_query($konek,"SELECT mata_pelajaran FROM pelajaran WHERE id_pelajaran=$data[id_pelajaran]");
                  $data_pelajaran=mysqli_fetch_array($query_pelajaran);
                  echo $data_pelajaran['mata_pelajaran']; ?></td>
                  <td><?php echo $data['jam']; ?></td>
                  
                  <td><?php echo $data['tahun_ajar']; ?></td>
                  <td><?php echo $data['semester']; ?></td>
                  <td><a href="https://absen-mtsannur.com/admin/jamngajar/edit/<?PHP echo $data['id_jam_mengajar']?>"class="btn btn-info">Edit</a></td>
                  <td><a href="https://absen-mtsannur.com/admin/jamngajar/hapus/<?PHP echo $data['id_jam_mengajar']?>"class="btn btn-danger">Hapus</a></td>
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
