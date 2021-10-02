<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/guru" class="tip-bottom"> Guru</a>
      <a href="#" class="current">Hapus</a> </div>
    <h1>Hapus Guru</h1>
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
                  <th>id guru</th>
                  <th>NIP</th>
                  <th>NUPTK</th>
                  <th>nama</th>
                  <th>P/L</th>
                  <th>alamat</th>
                  <th>status</th>
                  <th>jabatan</th>
                  <th>tanggal lahir</th>
                  <th colspan="2">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from guru where id_guru=$_GET[hapus]");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                  $kelamin=strtoupper($data['jenis_kelamin']);
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_guru']; ?></td>
                  <td><?php echo $data['nip']; ?></td>
                  <td><?php echo $data['nuptk']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $kelamin; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  <td><?php echo $data['jabatan']; ?></td>
                  <td><?php echo $data['tgl_lahir']; ?></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/proses.php?hapus_guru=<?PHP echo $data['id_guru']?>"class="btn btn-info">Ya</a></td>
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
