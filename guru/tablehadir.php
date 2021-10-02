<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 //deklarasi variable absen
 //pencarian data
 if(isset($_GET['carinama'])){
   $cari_nama_guru=$_GET['carinama'];
   $cari_bulan_guru=$_GET['bulan'];
   $query_tampil=mysqli_query($konek,"select * from kehadiran_guru where nama like '%$cari_nama_guru%' ORDER BY nama");
 }else {
   // query tampil
   $query_tampil=mysqli_query($konek,"SELECT * FROM kehadiran_guru ORDER BY nama ASC");
 }
 //end pencarian data
 ?>

 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="https://wahyuabsensi.gunungmas-seluler.com/petugas_piket/Hadir" class="tip-bottom">Kehadiran Guru</a> </div>
     <h1>Kehadiran Guru</h1>
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
                  
                  <th>tanggal</th>
                  <th>jam datang</th>
              
                  <th>Hapus</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select * from kehadiran_guru ORDER BY nip");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                  $nip=strtoupper($data['nip']);
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nip']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['tanggal']; ?></td>
                   <td><?php echo $data['jam']; ?></td>
                 
                 
                  <td><a href="https://wahyuabsensi.gunungmas-seluler.com/petugas_piket/hadir/hapus/<?PHP echo $data['id']?>"class="btn btn-danger">Hapus</a></td>
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
<?php include '../layout/footer.php'; ?>
