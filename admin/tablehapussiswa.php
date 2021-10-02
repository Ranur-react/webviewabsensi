<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/siswa" class="tip-bottom"> Siswa</a>
       <a href="#" class="current">Hapus</a> </div>
    <h1>Hapus siswa</h1>
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
                  <th>id siswa</th>
                  <th>nama</th>
                  <th>P/L</th>
                  <th>alamat</th>
                  <th>tanggal lahir</th>
                  <th>Nomor Telepon</th>
                  <th colspan="2">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"SELECT * FROM siswa where id_siswa=$_GET[hapus]");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                  $kelamin=strtoupper($data['jenis_kelamin']);
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_siswa']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $kelamin; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['tgl_lahir']; ?></td>
                  <td><?php echo $data['telepon']; ?></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/proses.php?hapus_siswa=<?PHP echo $data['id_siswa']?>"class="btn btn-info">Ya</a></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/guru/"class="btn btn-danger">Tidak</a></td>
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
