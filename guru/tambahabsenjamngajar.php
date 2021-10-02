<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 //deklarasi variable absen

 //deklarasi variable absen
 $keterangan_alpha=0;
 $keterangan_izin=0;
 $keterangan_sakit=0;
 $keterangan_terlambat=0;
 //pencarian data
 if(isset($_GET['carinis'])){
   $cari_nis_siswa=$_GET['carinis'];
   $cari_bulan_siswa=$_GET['bulan'];
   if($cari_nis_siswa==""){
     $query_tampil=mysqli_query($konek,"select * from siswa where kelas=$_GET[kelas] ORDER BY nama");
   }else{
     $query_tampil=mysqli_query($konek,"select * from siswa where id_siswa=$cari_nis_siswa ORDER BY nama");
   }
 }else {
   // query tampil
   $query_tampil=mysqli_query($konek,"select * from siswa where kelas=1 ORDER BY nama");
 }
 //end pencarian data
 ?>

 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="https://absen-mtsannur.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="https://absen-mtsannur.com/guru" class="tip-bottom">Guru</a> <a href="#" class="current">Absen</a></div>
     <h1>Siswa</h1>
   </div>

     <div class="container">
     <div class="span10">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>Absen Jam Ngajar</h5>
              </div>
              <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Jam Ngajar</th>
                  <th>Nama Guru</th>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Tanggal</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select e.jam_mulai,e.jam_selesai,e.tgl_ngajar,a.*,b.nama_kelas,c.mata_pelajaran,d.nama as nama_guru from jam_mengajar a join kelas b on a.id_kelas=b.id_kelas join pelajaran c on a.id_pelajaran=c.id_pelajaran join guru d on a.id_guru=d.id_guru join absen_jam_ngajar e on a.id_jam_mengajar=e.id_jam_mengajar join periode t1 on t1.id_periode=a.id_periode where t1.id_status='1' and d.nip='$_SESSION[username]'");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {
                  $aksi='<a href="https://absen-mtsannur.com/guru/ambil_absen/'.$data['id_jam_mengajar'].'"class="btn btn-success">Ambil Absen</a>';
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['id_jam_mengajar']; ?></td>
                  <td><?php echo $data['nama_guru']; ?></td>
                  <td><?php echo $data['nama_kelas']; ?></td>
                  <td><?php echo $data['mata_pelajaran']; ?></td>
                  <td><?php echo $data['tgl_ngajar']; ?></td>
                  <td><?php echo $data['jam_mulai']; ?></td>
                  <td><?php echo $data['jam_selesai']; ?></td>
                  <td><?php echo $aksi ?></td>
                  
                </tr>
                <?php $no++; } ?>
              </tbody>
                </table>

              </div>
          </div>

      </div>
        <div class="container">
          <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>Absen Jam Ngajar</h5>
              </div>
              <form method="post"action="./proses.php?kategori=absen_ngajar">
              <div class="widget-content">
                  
                  <div class="control-group">
                    <label class="control-label">Tanggal :</label>
                    <div class="controls">
                      <input type="date" name="tgl_ngajar" value="<?PHP echo date('Y-m-d'); ?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jam Mulai :</label>
                    <div class="controls">
                      <input type="text" name="jam_mulai" id="jam_mulai" placeholder="hh:mm:dd" required>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Jam Selesai :</label>
                    <div class="controls">
                      <input type="text" name="jam_selesai" id="jam_selesai" placeholder="hh:mm:dd" required>
                    </div>
                  </div>

                  <div class="control-group">
                  <label class="control-label">Jam Mengajar :</label>
                  <div class="controls">
                    <select name="id_jam_mengajar"id="id_jam_mengajar"required>
                    <?php $query_kelas=mysqli_query($konek,"select a.*,b.nama_kelas,c.mata_pelajaran,d.nama as nama_guru from jam_mengajar a join kelas b on a.id_kelas=b.id_kelas join pelajaran c on a.id_pelajaran=c.id_pelajaran join guru d on a.id_guru=d.id_guru join periode t1 on t1.id_periode=a.id_periode where t1.id_status='1' and d.nip='$_SESSION[username]'");
                    while ($data_kelas=mysqli_fetch_array($query_kelas)) { ?>
                      <option value="<?PHP echo $data_kelas['id_jam_mengajar']; ?>"><?PHP echo "Kelas:".$data_kelas['nama_kelas']." - Jam:".$data_kelas['jam']." - Mata Pelajaran:".$data_kelas['mata_pelajaran']; ?></option>
                    <?PHP } ?>
                    </select>
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
