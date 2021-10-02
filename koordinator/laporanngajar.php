<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';

 $nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
             'September','Oktober','November','Desember'];
             $tahun_bulan=date('Y-m');
 $ambil_bulan_t=0;
 $bulan_saat=date('m');
 $bulan_saatini=(int)$bulan_saat;
 ?>
<!--main-container-part-->
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="http://localhost/absensi2/koordinator/laporan" class="tip-bottom">Guru</a><a href="#" class="current">Laporan Jam Ngajar</a> </div>
    <h1>Laporan Jam Ngajar</h1>
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
            <a href="reportngajar.php?bulan=<?php echo $bulan_saatini."&tahun=".date('Y'); ?>"target="_blank">
              <span class="glyphicon glyphicon-print"></span><b> Print</b></a>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Guru</th>
                  <th>Nama</th>
                  <th>L/P</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1;
                $query_rekap=mysqli_query($konek,"SELECT * FROM guru ORDER BY nama");
                while ($data=mysqli_fetch_array($query_rekap)) {
                  $query_pel_guru=mysqli_query($konek,"SELECT id_guru FROM jam_mengajar WHERE id_guru=$data[id_guru]");
                  // $data_pel_guru=mysqli_fetch_array();
                  if (mysqli_num_rows($query_pel_guru)==0) {
                    continue;
                  }else{
                 ?>
                <tr>
                  <th><?php echo $no; ?></th>
                  <td><?php echo $data['id_guru']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo strtoupper($data['jenis_kelamin']); ?></td>
                  <?php
                  $query_jml=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE tgl_ngajar like '%$tahun_bulan%' AND id_guru=$data[id_guru]");
                  while ($data_jml=mysqli_fetch_array($query_jml)) {
                    echo "<td>$data_jml[0] Jam</td>"; } ?>
                  </tr> <?php $no++; } } ?>
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
                $q_ambil_bulan=mysqli_query($konek,"SELECT DISTINCT tgl_ngajar FROM absen_jam_ngajar ORDER BY tgl_ngajar");
                while ($t_bulan=mysqli_fetch_array($q_ambil_bulan)) {
                  //mengabil bulan
                  $ambil_bulan=explode("-",$t_bulan['tgl_ngajar']);
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
                <td><a href="reportngajar.php?bulan=<?php echo "$ambil_bulan_t&tahun=$ambil_bulan[0]"; ?>"target="_blank"
				><span class="glyphicon glyphicon-print"></span><b> Print</b></a></td>
                <td>
                  <a href="hapusngajar.php?bulan=<?php echo "$ambil_bulan_t&tahun=$ambil_bulan[0]"; ?>"onclick="return confirm('anda yakin untuk menghapus data ini')">
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
