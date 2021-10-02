<?php
 include '../db/koneksi.php';
 include 'akses.php';
 include '../layout/header.php';
 //deklarasi variable absen

 //deklarasi variable absen
 //deklarasi variable absen
 $keterangan_alpha=0;
 $keterangan_izin=0;
 $keterangan_sakit=0;
 $keterangan_terlambat=0;
 ?>


 <div id="content">
   <div id="content-header">
     <div id="breadcrumb"> <a href="http://localhost/absensi2/<?php echo $_SESSION['akses']; ?>/" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
       <a href="#" class="tip-bottom">Siswa</a> <a href="#" class="current">Absen</a></div>
     <h1>Siswa</h1>
   </div>

     <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>Absen Kelas</h5>
              </div>
              <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Nama Guru</th>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Tanggal</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Keterangan</th>
                  <th>Status</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query_tampil=mysqli_query($konek,"select i.id_status as id_status_periode,f.keterangan,f.id_absen_siswa,f.id_status,h.nisn,h.nama as nama_siswa,e.jam_mulai,e.jam_selesai,e.tgl_ngajar,a.*,b.nama_kelas,c.mata_pelajaran,d.nama as nama_guru from jam_mengajar a join kelas b on a.id_kelas=b.id_kelas join pelajaran c on a.id_pelajaran=c.id_pelajaran join guru d on a.id_guru=d.id_guru join absen_jam_ngajar e on a.id_jam_mengajar=e.id_jam_mengajar join detail_kelas g on b.id_kelas=g.id_kelas join siswa h on h.id_siswa=g.id_siswa left join absen_siswa f on f.id_siswa=h.id_siswa and f.id_jam_mengajar=a.id_jam_mengajar join periode i on i.id_periode=g.id_periode where h.nisn='$_SESSION[username]' order by e.id_absen_jam_ngajar desc limit 1");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {

                  if(empty($data['id_status'])){
                    $aksi='<a href="http://localhost/absensi2/siswa/proses.php?kategori=ambil_absen_ngajar&kehadiran=h&id_jam_mengajar='.$data['id_jam_mengajar'].'"class="btn btn-success">Klik Hadir</a><br><a href="http://localhost/absensi2/siswa/proses.php?kategori=ambil_absen_ngajar&kehadiran=i&id_jam_mengajar='.$data['id_jam_mengajar'].'"class="btn btn-info">Klik Izin</a><br><a href="http://localhost/absensi2/siswa/proses.php?kategori=ambil_absen_ngajar&kehadiran=s&id_jam_mengajar='.$data['id_jam_mengajar'].'"class="btn btn-warning">Klik Sakit</a>';
                    $keterangan="";
                  }else{
                    if($data['keterangan']=="h"){

                      $keterangan=strtoupper('hadir');
                    }else if($data['keterangan']=="i"){

                      $keterangan=strtoupper('izin');
                    }else if($data['keterangan']=="s"){

                      $keterangan=strtoupper('sakit');
                    }else{
                      $keterangan=strtoupper('alpha');
                    }
                    if($data['id_status']=="1"){
                      $aksi='<a class="btn btn-danger">Belum Di Approve</a><br><br><a href="http://localhost/absensi2/siswa/proses.php?kategori=batal_absen_ngajar&id_absen_siswa='.$data['id_absen_siswa'].'"class="btn btn-danger">Batal Absen</a>';
                    }else{
                      $aksi='<btn class="btn btn-success btn-xs">Telah Di Approve</btn>';
                    }                  
                  }
                  if($data['id_status_periode']=='1'){

                  
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
                  <td><?php echo $keterangan; ?></td>
                  <td><?php echo $aksi; ?></td>
                  
                </tr>
                <?php $no++; }} ?>
              </tbody>
                </table>

                <table class="table table-bordered data-table">
              <thead>
                <tr>
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
                <?php 
                
           //pencarian data
          $query_tampil=mysqli_query($konek,"select * from siswa where nisn='$_SESSION[username]' ORDER BY nama");
          //end pencarian data
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) { ?>
                <tr>
                  <td><?php echo $data['id_siswa']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jenis_kelamin']; ?></td>
                  <?php
                  //perulangan kehadiran sesuai tanggal
                  $nomor2=1;
                  //perulangan kehadiran sesuai tanggal
                 
                    $cari_bulan_siswa=date('m');
                    $tahun=date('Y');
                    $query_tampil_tanggal=mysqli_query($konek,"SELECT * FROM absen_siswa t1 join jam_mengajar t2 on t1.id_jam_mengajar=t2.id_jam_mengajar join periode t3 on t3.id_periode=t2.id_periode WHERE t3.id_status='1' and t1.id_siswa=$data[id_siswa]
                    and tgl_absen like '%$tahun-$cari_bulan_siswa%' and t1.id_status='2' ORDER BY t1.tgl_absen ASC;");
                 
                 while ($data_tanggal=mysqli_fetch_array($query_tampil_tanggal)) {
                    //mengabil tanggal
                    $ambil_tanggal=explode("-",$data_tanggal['tgl_absen']);
                    //merubah menjadi tanggal jadi integer
                    $ambil_tanggal[2]=(int)$ambil_tanggal[2];

                    //perulangan kehadiran sesuai tanggal
                    for($nomor=$nomor2;$nomor<=$ambil_tanggal[2];$nomor++){
                      if($nomor==$ambil_tanggal[2]){
                        if($data_tanggal['keterangan']=='h'){
                          echo '<td>H</td>';
                        }else{
                          echo "<td><b>".strtoupper($data_tanggal['keterangan'])."</b></td>";
                        }
                      }else {
                        echo "<td></td>";
                      }
                    }
                    // echo $ambil_tanggal[1];
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
        </div>

<?php include '../layout/footer.php'; ?>
