<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';

 $nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
             'September','Oktober','November','Desember'];
 $ambil_bulan_t=0;
 ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="http://localhost/absensi2/wali_kelas/laporan" class="current">siswa</a> </div>
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
          <div class="widget-content">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nama Bulan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Ambil absen perbulan -->
                <?php
                $q_ambil_bulan=mysqli_query($konek,"SELECT DISTINCT tgl_absen FROM absen_siswa ORDER BY tgl_absen");
                while ($t_bulan=mysqli_fetch_array($q_ambil_bulan)) {
                  //mengabil bulan
                  $ambil_bulan=explode("-",$t_bulan['tgl_absen']);
                  //merubah menjadi bulan jadi integer
                  $ambil_bulan[1]=(int)$ambil_bulan[1];
                  if ($ambil_bulan_t==$ambil_bulan[1]) {
                    continue;
                  }
                  $ambil_bulan_t=$ambil_bulan[1];
                  $pilih_bulan=$nama_bulan[$ambil_bulan_t-1];
                  ?>
                <tr class="odd gradeX">
                  <td><?php echo  "$ambil_bulan[0]-$pilih_bulan"; ?></td>
                  <td><a href="report.php?bulan=<?php echo "$ambil_bulan_t&tahun=$ambil_bulan[0]"; ?>"target="_blank">
                    <span class="glyphicon glyphicon-print"></span><b> Print</b></a>
                  </td>
                </tr>
                <?php } ?>
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
