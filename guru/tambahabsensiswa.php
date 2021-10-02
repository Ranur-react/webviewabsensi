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
 
   // query tampil
   $query_tampil=mysqli_query($konek,"select * from siswa t1 join detail_kelas t2 on t1.id_siswa=t2.id_siswa join jam_mengajar t3 on t3.id_kelas=t2.id_kelas join periode t4 on t2.id_periode=t4.id_periode where t4.id_status='1' and t3.id_jam_mengajar='$_GET[id_jam_mengajar]'");
 
 //end pencarian data
 ?>

 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="https://wahyuabsensi.gunungmas-seluler.com/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="https://wahyuabsensi.gunungmas-seluler.com/petugas_piket/siswa" class="tip-bottom">Siswa</a> <a href="#" class="current">Absen</a></div>
     <h1>Siswa</h1>
   </div>
   
     <div class="container">
   <div class="span7">
   <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <?php if(isset($_GET['carinis'])){ ?>
            <h5><?php echo "$_GET[tahun]-$_GET[bulan]"; ?></h5>
            <?php }else{?>
            <h5><?php echo date('Y-m'); ?></h5>
            <?PHP } ?>
          </div>
          <div class="widget-content">
            <div class="table-responsive">
              <form method="post"action="../proses.php?kategori=simpan_ambil_absen">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox"  /></th>
                  <th>NIS/ID_SISWA</th>
                  <th>Nama</th>
                  <th>L/P</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; while ($data=mysqli_fetch_array($query_tampil)) { 
                  $cek=mysqli_num_rows(mysqli_query($konek,"select * from absen_siswa where id_jam_mengajar='$_GET[id_jam_mengajar]' and id_siswa='$data[id_siswa]'"));

                  if($cek<1){

                  
                  ?>
                <tr>
                  <td><input type="checkbox" name="id_siswa[]"value="<?PHP echo $data['id_siswa']; ?>"  /></td>
                  <td><?php echo $data['id_siswa']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jenis_kelamin']; ?></td>
                  <?php
                  }
                }
                  ?>
                </tr>
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
              <disxv class="widget-content">
                  <input type="hidden" name="id_jam_mengajar" id="id_jam_mengajar" value="<?php echo $_GET['id_jam_mengajar'] ?>">
                  <div class="control-group">
                    <label class="control-label">Keterangan :</label>
                    <br>
                    <select name="keterangan">
                      <option value="">Pilih</option>
                      <option value="h">H</option>
                      <option value="i">I</option>
                      <option value="s">S</option>
                      <option value="a">A</option>
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
