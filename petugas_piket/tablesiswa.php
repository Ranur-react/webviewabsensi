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
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="http://localhost/absensi2/petugas_piket/siswa" class="tip-bottom">Siswa</a> <a href="#" class="current">Absen</a></div>
     <h1>Siswa</h1>
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
               <label class="control-label">NIS :</label>
               <div class="controls">
                 <input type="text"placeholder="NIS"name="carinis" />
               </div>
             </div><br>
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
               <button type="submit" class="btn btn-success">Cari</button>
             </div>
           </form>
         </div>
       </div>
     </div>
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
              <form method="post"action="./proses.php?kategori=absen_siswa">
            <table class="table table-bordered table-striped with-check">
              <thead>
                <tr>
                  <th rowspan='2'><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" /></th>
                  <th rowspan='2'>NIS/ID_SISWA</th>
                  <th rowspan='2'>Nama</th>
                  <th rowspan='2'>L/P</th>
                  <?php for ($tanggal_table=1; $tanggal_table <= 31; $tanggal_table++) {
                    echo "<th rowspan='2'>$tanggal_table</th>";
                  } ?>
                  <th colspan="4">Jumlah</th>
                </tr>
                <tr>
                  <th>A</th>
                  <th>I</th>
                  <th>S</th>
                  <th>T</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; while ($data=mysqli_fetch_array($query_tampil)) { ?>
                <tr>
                  <td><input type="checkbox" name="id_siswa[]"value="<?PHP echo $data['id_siswa']; ?>"/></td>
                  <td><?php echo $data['id_siswa']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jenis_kelamin']; ?></td>
                  <?php
                  //perulangan kehadiran sesuai tanggal
                  $nomor2=1;
                  //perulangan kehadiran sesuai tanggal
                  if(isset($_GET['bulan'])){
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_siswa WHERE
                    id_siswa=$data[id_siswa] and tgl_absen like '%$_GET[tahun]-$cari_bulan_siswa%' ORDER BY tgl_absen ASC;");
                  }else{
                    $cari_bulan_siswa=date('m');
                    $tahun=date('Y');
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_siswa WHERE id_siswa=$data[id_siswa]
                    and tgl_absen like '%$tahun-$cari_bulan_siswa%' ORDER BY tgl_absen ASC;");
                  }
                  while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                    //mengabil tanggal
                    $ambil_tanggal=explode("-",$data_tanggal['tgl_absen']);
                    //merubah menjadi tanggal jadi integer
                    $ambil_tanggal[2]=(int)$ambil_tanggal[2];

                    //perulangan kehadiran sesuai tanggal
                    for($nomor=$nomor2;$nomor<=$ambil_tanggal[2];$nomor++){
                      if($nomor==$ambil_tanggal[2]){
                        if($data_tanggal['keterangan']=='h'){
                          echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
                        }else{
                          echo "<td><b>".strtoupper($data_tanggal['keterangan'])."</b></td>";
                        }
                      }else {
                        echo "<td></td>";
                      }
                    }
                    //meng rekap bulannan
                    if($data_tanggal['keterangan']=='a'){
                      $keterangan_alpha++;
                    }else if($data_tanggal['keterangan']=='i'){
                      $keterangan_izin++;
                    }else if($data_tanggal['keterangan']=='s'){
                      $keterangan_sakit++;
                    }else if($data_tanggal['keterangan']=='t'){
                      $keterangan_alpha++;
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
                  //tampilan rekap absen
                    echo "<td>$keterangan_alpha</td>
                    <td>$keterangan_izin</td>
                    <td>$keterangan_sakit</td>
                    <td>$keterangan_terlambat</td>";
                    $keterangan_alpha=0;
                    $keterangan_sakit=0;
                    $keterangan_izin=0;
                    $keterangan_terlambat=0;
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
                    <label class="control-label">keterangan :</label>
                    <select name="kehadiran">
                      <option value="s">Sakit</option>
                      <option value="i">Izin</option>
                      <option value="a">alpha</option>
                      <option value="t">Terlambat</option>
                      <option value="h">Hadir</option>
                    </select>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Tanggal :</label>
                    <div class="controls">
                      <input type="date" name="tgl_absen" value="<?PHP echo date('Y-m-d'); ?>">
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
