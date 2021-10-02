<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php'; ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="https://wahyuabsensi.gunungmas-seluler.com/admin/siswa" class="current">Siswa</a> </div>
    <h1>Table siswa</h1>
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
                  <th>Nisn</th>
                  <th>nama</th>
                  <th>P/L</th>
                  <th>alamat</th>
                  <?php
                  if(!empty($_GET['detail'])){
                    ?>
                                      <th>kelas</th>
                    <?php
                  }
                  ?>
                  <th>tanggal lahir</th>
                  <th>Nomor Telepon</th>
                  <?php
                  if(!empty($_GET['detail'])){
                    ?>
                                      <th>Tahun Ajar</th>
                  <th>Semester</th>
                    <?php
                  }
                  ?>
                  
                  <th>edit</th>
                  <th>Hapus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                if(!empty($_GET['detail'])){
                  $query_tampil=mysqli_query($konek,"SELECT * FROM siswa t1 JOIN detail_kelas t2 ON t1.id_siswa=t2.id_siswa join kelas t3 on t2.id_kelas=t3.id_kelas join periode t4 on t2.id_periode=t4.id_periode where t4.id_status='1' and t2.id_kelas='$_GET[detail]' ORDER BY t2.id_kelas ASC");
                }else{
                  $query_tampil=mysqli_query($konek,"SELECT *,'-' as nama_kelas,'-' as tahun_ajar,'-' as semester FROM siswa t1 ORDER BY t1.nama ASC");
                }
                
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                  $kelamin=strtoupper($data['jenis_kelamin']);
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_siswa']; ?></td>
                  <td><?php echo $data['nisn']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $kelamin; ?></td>
                  <td><?php echo $data['alamat']; ?></td>
                  <?php
                  if(!empty($_GET['detail'])){
                    ?>
                    
                  <td><?php echo $data['nama_kelas']; ?></td>
                    <?php
                  }
                  ?>
                  <td><?php echo $data['tgl_lahir']; ?></td>
                  <td><?php echo $data['telepon']; ?></td>
                  <?php
                  if(!empty($_GET['detail'])){
                    ?>
                    
                    <td><?php echo $data['tahun_ajar']; ?></td>
                  <td><?php echo $data['semester']; ?></td>
                    <?php
                  }
                  ?>
                  
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/siswa/edit/<?PHP echo $data['id_siswa']?>"class="btn btn-info">Edit</a></td>
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/admin/siswa/hapus/<?PHP echo $data['id_siswa']?>"class="btn btn-danger">Hapus</a></td>
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
