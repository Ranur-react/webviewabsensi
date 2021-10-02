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
    <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
      <a href="https://absen-mtsannur.com/kesiswaan/laporan" class="tip-bottom">siswa</a><a href="#" class="current">Laporan Absen</a> </div>
    <h1>Laporan Absen Siswa</h1>
  </div>
  <div class="container">
    <div class="span11">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
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
              <label class="control-label">Siswa :</label>
              <br>
              <select name="mp">
                <?php
                $query_mp=mysqli_query($konek,"SELECT * FROM siswa order by nama ASC");
                while ($data_mp=mysqli_fetch_array($query_mp)) {
                  echo "<option value='$data_mp[id_siswa]'>$data_mp[nama]</option>";
                }
                 ?>
              </select>
            </div>
            <div class="control-group">
              <label class="control-label">Bulan :</label><br>
              <select name="bulan">
                <?php
                $nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
                            'September','Oktober','November','Desember'];
                for($nomor_bulan=1;$nomor_bulan<=12;$nomor_bulan++){
                  if($nomor_bulan<10){
                  echo "<option value='$nomor_bulan'>".$nama_bulan[$nomor_bulan-1]."</option>";
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
                  <th>Kelas</th>
				  <th>Bulan/Tahun</th>
				  <th>Siswa</th>
                  <th>Print</th>
                </tr>
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <?php $bulan=intval($_GET['bulan']-1); ?>
					<td>
						<?php
						$query_kelas=mysqli_query($konek,"SELECT * FROM kelas WHERE id_kelas='$_GET[kelas]'");
						while ($data_kelas=mysqli_fetch_assoc($query_kelas)) { ?>
						<?PHP echo $data_kelas['nama_kelas']; }?>
					</td>
					<td><?php echo "$nama_bulan[$bulan] - $_GET[tahun]"; ?></td>
					<td>
						<?php
						$getmp=mysqli_query($konek,"SELECT * FROM siswa WHERE id_siswa='$_GET[mp]'");
						while ($getm=mysqli_fetch_assoc($getmp)) { ?>
						<?php echo "$getm[nama]"; }?></td>
					<td><a href="report2.php?bulan=<?php echo "$_GET[bulan]&tahun=$_GET[tahun]&kelas=$_GET[kelas]&siswa=$_GET[mp]"; ?>"target="_blank">
						<i class="icon-print"></i>
						</a></td>
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
