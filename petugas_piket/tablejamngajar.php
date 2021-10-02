<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 //deklarasi variable absen
 $keterangan_alpha=0;
 $keterangan_izin=0;
 $keterangan_sakit=0;
$keterangan_terlambat=0;
$nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
            'September','Oktober','November','Desember'];
            if (isset($_GET['cari'])) {
              $cari_nama_guru=$_GET['nama'];
              $cari_bulan_guru=$_GET['bulan'];
              if($cari_nama_guru!=""){
                $query_tampil=mysqli_query($konek,"SELECT * FROM guru WHERE nama LIKE '%$cari_nama_guru%' ORDER BY guru.nama");
              }else{
                $query_tampil=mysqli_query($konek,"SELECT * FROM guru ORDER BY guru.nama");
              }
            }else{
              $query_tampil=mysqli_query($konek,"SELECT * FROM guru ORDER BY guru.nama");
            }
 //end pencarian data
 ?>
 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="http://localhost/absensi2/petugas_piket/jamngajar" class="current">Jam Ngajar Guru</a> </div>
     <h1>Jam Mengajar</h1>
   </div>
   <div class="container">
   <div class="span7">
   <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
          <?php if(isset($_GET['cari'])){ ?>
          <h5><?php echo "$_GET[tahun]-$_GET[bulan]"; ?></h5>
          <?php }else{?>
          <h5><?php echo date('Y-m'); ?></h5>
          <?PHP } ?>
          </div>
        <div class="widget-content">
          <div class="table-responsive">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
                    echo "<th rowspan='2'>$tanggal_table</th>";
                  } ?>
                  <th>Jumlah Perbulan</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no=1;
                while ($data=mysqli_fetch_array($query_tampil)) {
                  $query_pel_guru=mysqli_query($konek,"SELECT id_guru FROM jam_mengajar WHERE id_guru=$data[id_guru]");
                  // $data_pel_guru=mysqli_fetch_array();
                  if (mysqli_num_rows($query_pel_guru)==0) {
                    continue;
                  }else {
                   ?>
                <tr>
                  <td><?php echo $no;$no++; ?></td>
                  <td> <?php
                  if (isset($_GET['bulan'])) {
                    echo "<a href='http://localhost/absensi2/petugas_piket/jamngajar/$data[id_guru]/$_GET[tahun]/$cari_bulan_guru/'>$data[nama]</a>";
                  }else {
                    $cari_bulan_guru=date('m');
                    $tahun=date('Y');
                    echo "<a href='http://localhost/absensi2/petugas_piket/jamngajar/$data[id_guru]/$tahun/$cari_bulan_guru/'>$data[nama]</a>";
                  }
                  ?></td>
                  <?php
                  $nomor2=1;
                  if(isset($_GET['bulan'])){
                      $query_tampil_tanggal=mysqli_query($konek,"SELECT tgl_ngajar FROM absen_jam_ngajar WHERE
                        id_guru=$data[id_guru] and tgl_ngajar like '%$_GET[tahun]-$cari_bulan_guru%' ORDER BY tgl_ngajar ASC;");
                  }else{
                    $cari_bulan_guru=date('m');
                    $tahun=date('Y');
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT tgl_ngajar FROM absen_jam_ngajar WHERE id_guru=$data[id_guru]
                    and tgl_ngajar like '%$tahun-$cari_bulan_guru%' ORDER BY tgl_ngajar ASC;");
                  }
                  while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                    //mengabil tanggal

                    $ambil_tanggal=explode("-",$data_tanggal['tgl_ngajar']);
                    //merubah menjadi tanggal jadi integer
                    $ambil_tanggal[2]=(int)$ambil_tanggal[2];
                    //perulangan kehadiran sesuai tanggal
                    for($nomor=$nomor2;$nomor<=$ambil_tanggal[2];$nomor++){
                      if($nomor==$ambil_tanggal[2]){
                        if(isset($_GET['bulan'])){
                          $query_tampil_jumlah=mysqli_query($konek,"SELECT SUM(jumlah_jam) FROM absen_jam_ngajar WHERE
                          id_guru=$data[id_guru] and tgl_ngajar='$_GET[tahun]-$cari_bulan_guru-$ambil_tanggal[2]' ORDER BY tgl_ngajar ASC;");
                        }else{
                          $cari_bulan_guru=date('m');
                          $tahun=date('Y');
                          $query_tampil_jumlah=mysqli_query($konek,"SELECT SUM(jumlah_jam) FROM absen_jam_ngajar WHERE
                          id_guru=$data[id_guru] and tgl_ngajar='$tahun-$cari_bulan_guru-$ambil_tanggal[2]' ORDER BY tgl_ngajar ASC;");
                        }
                         $data_jumlah=mysqli_fetch_array($query_tampil_jumlah);
                        if($data_jumlah[0]!=''){
                          echo "<td>$data_jumlah[0]</td>";
                        }else{
                          echo "<td></td>";
                        }
                      }else {
                        echo "<td></td>";
                      }
                    }
                    $nomor2=$ambil_tanggal[2]+1;
                    $sisa_td=31-$nomor2;
                  }
                  if(isset($sisa_td)!=true){
                    $sisa_td=30;
                  }
                  for ($td=0; $td <= $sisa_td ; $td++) {
                    echo "<td></td>";
                  }
                  if(isset($_GET['bulan'])){
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE
                    id_guru=$data[id_guru] and tgl_ngajar like '%$_GET[tahun]-$cari_bulan_guru%';");
                  }else{
                    $cari_bulan_guru=date('m');
                    $tahun=date('Y');
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE
                    id_guru=$data[id_guru] and tgl_ngajar like '%$tahun-$cari_bulan_guru%';");
                  }
                    while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                        echo "<td>$data_tanggal[0]</td>";
                      }
                   ?>
                </tr>
                <?php  }  }?>
              </tbody>
            </table>
          </div>
              <div class="table-responsive">
            <form method="get">

        </div>
   </div>
      </div>
      </div>
      <div class="container">
        <div class="span4">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
              <h5>Pengabsenan</h5>
            </div>
            <div class="widget-content">
              <div class="control-group">
                <label class="control-label">nama :</label>
                <div class="controls">
                  <input type="text" name="nama">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Bulan :</label><br>
                <select name="bulan">
                  <?php
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
                  <button type="submit" name="cari"class="btn btn-success">Cari</button>
                </div>
              </form>
               </div>
            </div>
          </div>
        </div>
      </div>
      </div>
   </div>

<?php include '../layout/footer.php'; ?>
