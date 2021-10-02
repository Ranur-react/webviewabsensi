<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
$nama_bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus',
            'September','Oktober','November','Desember'];
$query_tampil=mysqli_query($konek,"SELECT * FROM guru JOIN jam_mengajar ON guru.id_guru=jam_mengajar.id_guru WHERE guru.id_guru=$_GET[id_guru] ORDER BY guru.nama");
 //end pencarian data
 ?>
 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="http://localhost/absensi2/petugas_piket/jamngajar" class="current">Jam Ngajar</a></div>
     <h1>Jam Mengajar</h1>
   </div>
   <div class="container">
     <div class="span11">
     <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            Guru
            </div>
            <div class="widget-content">
              <?php
              $query=mysqli_query($konek,"SELECT * FROM guru WHERE id_guru=$_GET[id_guru]");
               while ($data=mysqli_fetch_array($query)) { ?>
                  <p><b>NIP           :</b> <?php echo $data['nip']; ?></p>
                  <p><b>NUPTK         :</b> <?php if ($data['nuptk']=="0") { echo "-"; }else{ echo $data['nuptk']; } ?></p>
                  <p><b>Nama          :</b> <?php echo $data['nama']; ?></p>
                  <p><b>Jenis Kelamin :</b> <?php echo $data['jenis_kelamin']; ?></p>
                  <p><b>Status        :</b> <?php echo $data['status']; ?></p>
                  <p><b>Alamat        :</b> <?php echo $data['alamat']; ?></p>
                  <p><b>Jabatan       :</b> <?php echo $data['jabatan']; ?></p>
                  <p><b>Telepon       :</b> <?php echo $data['telepon']; ?></p>
                  <p><b>Tanggal Lahir :</b> <?php echo $data['tgl_lahir']; ?></p>

              <?php } ?>
            </div>
        </div>
     </div>
     <div class="span7">
     <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5><?php echo "$_GET[tahun]-$_GET[bulan]"; ?></h5>
            </div>
          <div class="widget-content">
            <div class="table-responsive">
              <form method="post"action="http://localhost/absensi2/petugas_piket/proses.php?kategori=absen_jam_ngajar&id=<?PHP echo $_GET['id_guru']; ?>">
              <table border="1"class="with-check">
                <thead>
                  <tr>
                    <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
                      echo "<th rowspan='2'>$tanggal_table</th>";
                    } ?>
                    <th>Jumlah Perbulan</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                  while ($data=mysqli_fetch_array($query_tampil)) {
                     ?>
                  <tr>
                    <td><input type="checkbox" name="id_jam_mengajar[]"value="<?PHP echo $data['id_jam_mengajar']."_".$data['id_guru']; ?>"/></td>
                    <td> <?php
                    $query_kelas=mysqli_query($konek,"SELECT nama_kelas FROM kelas WHERE id_kelas=$data[id_kelas]");
                    $data_kelas=mysqli_fetch_array($query_kelas);
                    echo "$data_kelas[nama_kelas]"; ?></td>
                    <td> <?php
                    $query_pelajaran=mysqli_query($konek,"SELECT mata_pelajaran FROM pelajaran WHERE id_pelajaran=$data[id_pelajaran]");
                    $data_pelajaran=mysqli_fetch_array($query_pelajaran);
                    echo "$data_pelajaran[mata_pelajaran]"; ?></td>
                    <?php
                    $nomor2=1;
                          $query_tampil_tanggal=mysqli_query($konek,"SELECT tgl_ngajar FROM absen_jam_ngajar WHERE id_jam_mengajar=$data[id_jam_mengajar]
                          and tgl_ngajar like '%$_GET[tahun]-$_GET[bulan]%' ORDER BY tgl_ngajar ASC;");
                    while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                      //mengabil tanggal

                      $ambil_tanggal=explode("-",$data_tanggal['tgl_ngajar']);
                      //merubah menjadi tanggal jadi integer
                      $ambil_tanggal[2]=(int)$ambil_tanggal[2];
                      //perulangan kehadiran sesuai tanggal
                      for($nomor=$nomor2;$nomor<=$ambil_tanggal[2];$nomor++){
                        if($nomor==$ambil_tanggal[2]){
                          $query_tampil_jumlah=mysqli_query($konek,"SELECT SUM(jumlah_jam) FROM absen_jam_ngajar WHERE
                           id_jam_mengajar=$data[id_jam_mengajar] and tgl_ngajar='$_GET[tahun]-$_GET[bulan]-$ambil_tanggal[2]' ORDER BY tgl_ngajar ASC;");
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
                    $cari_bulan_guru=date('m');
                    $tahun=date('Y');
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT sum(jumlah_jam) FROM absen_jam_ngajar WHERE
                      id_jam_mengajar=$data[id_jam_mengajar] and tgl_ngajar like '%$_GET[tahun]-$_GET[bulan]%';");
                      while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                          echo "<td>$data_tanggal[0]</td>";
                        }
                     ?>
                  </tr>
                  <?php  }  ?>
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

<?php include '../layout/footer.php'; ?>
