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
$query_tampil=mysqli_query($konek,"SELECT * FROM jam_mengajar ORDER BY id_guru");
 //end pencarian data
 ?>
 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="http://localhost/absensi2/petugas_piket/jamngajar" class="current">Jam Ngajar</a> </div>
     <h1>Jam Mengajar</h1>
   </div>
   <div class="container">
   <div class="span7">
   <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
          <?php if(isset($_GET['carinama'])){ ?>
          <h5><?php echo "$_GET[tahun]-$_GET[bulan]"; ?></h5>
          <?php }else{?>
          <h5><?php echo date('Y-m'); ?></h5>
          <?PHP } ?>
          </div>
        <div class="widget-content">
          <div class="table-responsive">
            <form method="post"action="./proses.php?kategori=absen_jam_ngajar">
          <table class="table table-bordered table-striped with-check">
            <thead>
              <tr>
                <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Jumlah Jam</th>
                <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
                  echo "<th rowspan='2'>$tanggal_table</th>";
                } ?>
                <th>Jumlah Perbulan</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($data=mysqli_fetch_array($query_tampil)) { ?>
              <tr>
                <td><input type="checkbox" name="id_jam_mengajar[]"value="<?PHP echo $data['id_jam_mengajar']."_".$data['id_guru']; ?>"/></td>
                <td><?php
                $query_tampil2=mysqli_query($konek,"select nama from guru WHERE id_guru=$data[id_guru]");
                $data2=mysqli_fetch_array($query_tampil2);
                echo $data2['nama']; ?></td>
                <td><?php
                $query_kelas=mysqli_query($konek,"SELECT nama_kelas FROM kelas WHERE id_kelas=$data[id_kelas]");
                $data_kelas=mysqli_fetch_array($query_kelas);
                echo $data_kelas['nama_kelas']; ?></td>
                <td><?php
                    $query_pelajaran=mysqli_query($konek,"SELECT mata_pelajaran FROM pelajaran WHERE id_pelajaran=$data[id_pelajaran]");
                $data_pelajaran=mysqli_fetch_array($query_pelajaran);
                echo $data_pelajaran['mata_pelajaran']; ?></td>
                <td><?php echo $data['jam']; ?></td>
                <?php
                $nomor2=1;
                if(isset($_GET['bulan'])){
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_jam_ngajar WHERE
                      id_jam_mengajar=$data[id_jam_mengajar] and tgl_ngajar like '%$_GET[tahun]-$cari_bulan_guru%' ORDER BY tgl_ngajar ASC;");
                }else{
                  $cari_bulan_guru=date('m');
                  $tahun=date('Y');
                  $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_jam_ngajar WHERE id_jam_mengajar=$data[id_jam_mengajar]
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
                      if($data_tanggal['jumlah_jam']!=''){
                        echo "<td>$data_tanggal[jumlah_jam]</td>";
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
                $cari_bulan_guru=date('m');
                $tahun=date('Y');
                $query_tampil_tanggal=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE
                  id_jam_mengajar=$data[id_jam_mengajar] and tgl_ngajar like '%$tahun-$cari_bulan_guru%';");
                  while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                      echo "<td>$data_tanggal[0]</td>";
                    }
                 ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
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
                <label class="control-label">Jam :</label>
                <div class="controls">
                  <input type="number" name="jam">
                </div>
              </div>
                <div class="control-group">
                  <label class="control-label">Tanggal :</label>
                  <div class="controls">
                    <input type="date" name="tgl_ngajar" value="<?PHP echo date('Y-m-d'); ?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Aksi :</label>
                  <select name="aksi">
                    <option value="absen_baru">Baru</option>
                    <option value="edit_absen">Edit</option>
                    <option value="hapus_absen">Hapus</option>
                  </select>
                </div>
                <br>
                <div class="form-actions">
                  <button type="submit" class="btn btn-success">Save</button>
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
