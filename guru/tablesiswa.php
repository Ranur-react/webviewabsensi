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
     <div class="span12">
            <div class="widget-box">
              <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>Absen Jam Ngajar</h5>
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
                $query_tampil=mysqli_query($konek,"select f.keterangan,f.id_absen_siswa,f.id_status,g.nisn,g.nama as nama_siswa,e.jam_mulai,e.jam_selesai,e.tgl_ngajar,a.*,b.nama_kelas,c.mata_pelajaran,d.nama as nama_guru from jam_mengajar a join kelas b on a.id_kelas=b.id_kelas join pelajaran c on a.id_pelajaran=c.id_pelajaran join guru d on a.id_guru=d.id_guru join absen_jam_ngajar e on a.id_jam_mengajar=e.id_jam_mengajar join absen_siswa f on e.id_jam_mengajar=f.id_jam_mengajar join siswa g on f.id_siswa=g.id_siswa join periode t1 on t1.id_periode=a.id_periode where t1.id_status='1' and d.nip='$_SESSION[username]' order by e.id_jam_mengajar desc");
                $no=1; while ($data=mysqli_fetch_array($query_tampil)) {

                  if($data['id_status']=="1"){
                    $aksi='<a href="https://absen-mtsannur.com/guru/proses.php?kategori=absen_ngajar_approve&id_absen_siswa='.$data['id_absen_siswa'].'"class="btn btn-danger">Belum Di Approve</a>';
                  }else{
                    $aksi='<btn class="btn btn-success btn-xs">Telah Di Approve</btn>
                    <br><br><a href="https://absen-mtsannur.com/guru/proses.php?kategori=batal_absen_ngajar_approve&id_absen_siswa='.$data['id_absen_siswa'].'"class="btn btn-danger">Batal Approve</a>';
                  }

                  if($data['keterangan']=="h"){

                      $keterangan=strtoupper('hadir');
                    }else if($data['keterangan']=="i"){

                      $keterangan=strtoupper('izin');
                    }else if($data['keterangan']=="s"){

                      $keterangan=strtoupper('sakit');
                    }else{
                      $keterangan=strtoupper('alpha');
                    }
                 ?>
                <tr class="gradeX">
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data['nama_siswa']; ?></td>
                  <td><?php echo $data['nama_guru']; ?></td>
                  <td><?php echo $data['nama_kelas']; ?></td>
                  <td><?php echo $data['mata_pelajaran']; ?></td>
                  <td><?php echo $data['tgl_ngajar']; ?></td>
                  <td><?php echo $data['jam_mulai']; ?></td>
                  <td><?php echo $data['jam_selesai']; ?></td>
                  <td><?php echo $keterangan; ?></td>
                  <td><?php echo $aksi; ?></td>
                  
                </tr>
                <?php $no++; } ?>
              </tbody>
                </table>

              </div>
          </div>

      </div>
        
        </div>
        </div>
 </div>
<?php include '../layout/footer.php'; ?>
