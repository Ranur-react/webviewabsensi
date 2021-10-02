<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';

 $nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
             'September','Oktober','November','Desember'];
 $ambil_bulan_t=0;
 $keterangan_alpha=0; $keterangan_izin=0; $keterangan_sakit=0; $keterangan_terlambat=0;
 $tahun_bulan=date('Y-m');
 $bulan_saat=date('m');
 $bulan_saatini=(int)$bulan_saat;
 $data_total=0;
 ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="http://localhost/absensi2/koordinator/laporan" class="tip-bottom">Guru</a> <a href="http://localhost/absensi2/koordinator/laporan" class="current">Laporan Absen</a> </div>
    <h1>Laporan Absen Guru</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php echo $tahun_bulan; ?></h5>
          </div>
          <div class="widget-content">
            <a href="report.php?bulan=<?php echo $bulan_saatini."&tahun=".date('Y'); ?>"target="_blank">
              <span class="glyphicon glyphicon-print"></span><b> Print</b></a>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">id guru</th>
                  <th rowspan="2">Nama</th>
                  <th rowspan="2">L/P</th>
                  <th colspan="4"><p align="center">Jumlah</p></th>
                  <th rowspan="2"><p align="center">Jumlah Total</p></th>
                </tr>
                <tr>
                    <th>A</th>
                    <th>I</th>
                    <th>S</th>
                    <th>T</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1;
                 $query_rekap=mysqli_query($konek,"SELECT * FROM guru ORDER BY nama");
                 while ($data=mysqli_fetch_array($query_rekap)) {
                   $query_jml=mysqli_query($konek,"SELECT * FROM absen_guru WHERE tgl_absen like '%$tahun_bulan%' AND id_guru=$data[id_guru]");
                    while ($data_jml=mysqli_fetch_array($query_jml)) {
                       if($data_jml['keterangan']=='s'){ $keterangan_sakit++; }
                       else if ($data_jml['keterangan']=='i') { $keterangan_izin++; }
                       else if ($data_jml['keterangan']=='a') { $keterangan_alpha++; }
                       else if ($data_jml['keterangan']=='t') { $keterangan_terlambat++; }
                        $data_total=$keterangan_alpha+$keterangan_sakit+$keterangan_izin;} ?><tr>
                  <th><?php echo $no; ?></th>
                  <td><?php echo $data['id_guru']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo strtoupper($data['jenis_kelamin']); ?></td>
                  <td><?php echo $keterangan_alpha; ?></td>
                  <td><?php echo $keterangan_izin; ?></td>
                  <td><?php echo $keterangan_sakit; ?></td>
                  <td><?php echo $keterangan_terlambat; ?></td>
                  <td><?php echo $data_total; ?></td>
                </tr> <?php $no++; $keterangan_alpha=0; $keterangan_izin=0; $keterangan_sakit=0; $keterangan_terlambat=0;} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
                  <th colspan="2">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Ambil absen perbulan -->
              <?php
                $q_ambil_bulan=mysqli_query($konek,"SELECT DISTINCT tgl_absen FROM absen_guru ORDER BY tgl_absen");
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
              <tr>
                <td><?php echo  "$ambil_bulan[0]-$pilih_bulan"; ?></td>
                <td><a href="report.php?bulan=<?php echo "$ambil_bulan_t&tahun=$ambil_bulan[0]"; ?>"target="_blank">
                  <span class="glyphicon glyphicon-print"></span><b> Print</b></a></td>
                <td>
                  <a href="hapus.php?bulan=<?php echo "$ambil_bulan_t&tahun=$ambil_bulan[0]"; ?>"onclick="return confirm('anda yakin untuk menghapus data ini')">
                    <span class="glyphicon glyphicon-trash"></span><b> Hapus</b>
                  </a>
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
