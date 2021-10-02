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
    <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://wahyuabsensi.gunungmas-seluler.com/kesiswaan/laporan" class="tip-bottom">siswa</a><a href="#" class="current">Laporan Absen</a> </div>
    <h1>Laporan Absen Siswa</h1>
  </div>
  <div class="container">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span
          <h5>Cari</h5>
        </div>
        <div class="widget-content">
          <form method="get">
            <div class="control-group">
              <label class="control-label">Pilih Kelas :</label>
              <br>
              <select name="kelas">
                <?php
                $query_kelas=mysqli_query($konek,"SELECT * FROM kelas");
                while ($data_kelas=mysqli_fetch_array($query_kelas)) {
                  echo "<option value='$data_kelas[id_kelas]'>$data_kelas[nama_kelas]</option>";
                }
                 ?>
              </select>
            </div>
            <div class="control-group">
              <label class="control-label">Bulan :</label><br>
              <select name="bulan">
                <?php
                if($_GET['bulan']<10){

                    $bulannya="0".$_GET['bulan'];
                }else{

                    $bulannya=$_GET['bulan'];
                }
                $nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
                            'September','Oktober','November','Desember'];
                for($nomor_bulan=1;$nomor_bulan<=12;$nomor_bulan++){
                  if($nomor_bulan<10){
                  echo "<option value='0$nomor_bulan'>".$nama_bulan[$nomor_bulan-1]."</option>";
                }else {
                    echo "<option value='$nomor_bulan'>".$nama_bulan[$nomor_bulan-1]."</option>";
                  }
                }
                 ?>
              </select>
            </div><br>
            <div class="control-group">
              <label class="control-label">Tahun :</label>
              <div class="controls">
                <input type="number"placeholder="Tahun"name="tahun" value="<?PHP echo date('Y'); ?>"/>
              </div>
            </div><br>
            <div class="form-actions">
              <button type="submit" class="btn btn-success"name="cari">Cari</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php if(isset($_GET['cari'])){ ?>
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
                  <th>Print</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <?php $bulan=intval($_GET['bulan']-1); ?>
                  <td><?php echo  "$_GET[tahun]-$nama_bulan[$bulan]"; ?></td>
                  <td>
                    <?php
                    $query_kelas=mysqli_query($konek,"SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'");
                    while ($data_kelas=mysqli_fetch_assoc($query_kelas)) { ?>
                    <a href="report.php?bulan=<?php echo "$bulannya&tahun=$_GET[tahun]&kelas=$_GET[kelas]"; ?>"target="_blank">
                    <span class="glyphicon glyphicon-print"></span><b><?PHP echo $data_kelas['nama_kelas']; ?></b></a><?PHP } ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<!--end-main-container-part-->
<?php include '../layout/footer.php'; ?>
