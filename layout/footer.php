
<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"style="
    color: #fff;
    font-weight: bold;
    font-size: 15px;
">
     <?php echo "$header_photo[alamat] | $header_photo[email] | contac : $header_photo[telepon]"; ?> </div>
</div>

<!--end-Footer-part-->
<?php $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
  if ($actual_link=="https://wahyuabsensi.gunungmas-seluler.com/petugas_piket/index.php"
    or $actual_link=="https://wahyuabsensi.gunungmas-seluler.com/kesiswaan/index.php"
    or $actual_link=="https://wahyuabsensi.gunungmas-seluler.com/koordinator/index.php"
    or $actual_link=="https://wahyuabsensi.gunungmas-seluler.com/wali_kelas/index.php") {
?>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/bootstrap.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.flot.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.flot.resize.min.js"></script>

<!--Turning-series-chart-js-->
<script type="text/javascript">
$(function () {
  <?php
  if (isset($_SESSION['id_kelas'])) {
    $tambahan="AND siswa.kelas=$_SESSION[id_kelas]";
  }else{
    $tambahan="";
  }
   ?>
    var datasets = {
        "izin": {
            label: "IZIN",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(absen_siswa.id_absen_siswa) FROM absen_siswa
              JOIN siswa ON siswa.id_siswa=absen_siswa.id_siswa
              WHERE absen_siswa.keterangan='i' AND absen_siswa.tgl_absen LIKE '$bulan-$tanggal_d' $tambahan");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "sakit": {
            label: "SAKIT",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(absen_siswa.id_absen_siswa) FROM absen_siswa
              JOIN siswa ON siswa.id_siswa=absen_siswa.id_siswa
              WHERE absen_siswa.keterangan='s' AND absen_siswa.tgl_absen LIKE '$bulan-$tanggal_d' $tambahan");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "alpha": {
            label: "ALPHA",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(absen_siswa.id_absen_siswa) FROM absen_siswa
              JOIN siswa ON siswa.id_siswa=absen_siswa.id_siswa
              WHERE absen_siswa.keterangan='a' AND absen_siswa.tgl_absen LIKE '$bulan-$tanggal_d' $tambahan");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "terlambat": {
            label: "TERLAMBAT",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(absen_siswa.id_absen_siswa) FROM absen_siswa
              JOIN siswa ON siswa.id_siswa=absen_siswa.id_siswa
              WHERE absen_siswa.keterangan='t' AND absen_siswa.tgl_absen LIKE '$bulan-$tanggal_d' $tambahan");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        }
    };

    // hard-code color indices to prevent them from shifting as
    // countries are turned on/off
    var i = 0;
    $.each(datasets, function(key, val) {
        val.color = i;
        ++i;
    });

    // insert checkboxes
    var choiceContainer = $("#choices");
    $.each(datasets, function(key, val) {
        choiceContainer.append('<br/><input type="checkbox" name="' + key +
                               '" checked="checked" id="id' + key + '">' +
                               '<label for="id' + key + '">'
                                + val.label + '</label>');
    });
    choiceContainer.find("input").click(plotAccordingToChoices);


    function plotAccordingToChoices() {
        var data = [];

        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasets[key])
                data.push(datasets[key]);
        });

        if (data.length > 0)
            $.plot($("#placeholder"), data, {
                yaxis: { min: 0 },
                xaxis: { tickDecimals: 0 }
            });
    }

    plotAccordingToChoices();
    <?php if ($actual_link=="https://wahyuabsensi.gunungmas-seluler.com/petugas_piket/index.php"
    or $actual_link=="https://wahyuabsensi.gunungmas-seluler.com/koordinator/index.php") {?>
    var datasets2 = {
        "izin2": {
            label: "IZIN",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(id_absen_guru) FROM absen_guru
              WHERE absen_guru.keterangan='i' AND absen_guru.tgl_absen LIKE '$bulan-$tanggal_d'");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "sakit2": {
            label: "SAKIT",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(id_absen_guru) FROM absen_guru
              WHERE absen_guru.keterangan='s' AND absen_guru.tgl_absen LIKE '$bulan-$tanggal_d'");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "alpha2": {
            label: "ALPHA",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(id_absen_guru) FROM absen_guru
              WHERE absen_guru.keterangan='a' AND absen_guru.tgl_absen LIKE '$bulan-$tanggal_d'");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        },
        "terlambat2": {
            label: "TERLAMBAT",
            <?php
            $bulan=date('Y-m');
            $tanggal=date('d');
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              $query_izin=mysqli_query($konek,"SELECT COUNT(id_absen_guru) FROM absen_guru
              WHERE absen_guru.keterangan='t' AND absen_guru.tgl_absen LIKE '$bulan-$tanggal_d'");
              $data_izin=mysqli_fetch_array($query_izin);
              $jumlah_izin[$i]=$data_izin[0];
            }
             ?>
            data: [<?php
            for ($i=0; $i < 7; $i++) {
              $tanggal_d=$tanggal-$i;
              if ($i==6) {
                echo " [$tanggal_d,$jumlah_izin[$i]]";
              }else {
                echo "[$tanggal_d,$jumlah_izin[$i]],";
              }
            }
             ?>
                  ]
        }
    };

    var i = 0;
    $.each(datasets2, function(key, val) {
        val.color = i;
        ++i;
    });

    // insert checkboxes
    var choiceContainer = $("#choices2");
    $.each(datasets2, function(key, val) {
        choiceContainer.append('<input type="checkbox" name="' + key +
                               '" checked="checked" id="id' + key + '">' +
                               '<label for="id' + key + '">'
                                + val.label + '</label>');
    });
    choiceContainer.find("input").click(plotAccordingToChoices2);


    function plotAccordingToChoices2() {
        var data = [];

        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasets2[key])
                data.push(datasets2[key]);
        });

        if (data.length > 0)
            $.plot($("#placeholder2"), data, {
                yaxis: { min: 0 },
                xaxis: { tickDecimals: 0 }
            });
    }

    plotAccordingToChoices2();
    <?php } ?>
});
</script>
<!--Turning-series-chart-js-->
<?php }else{ ?>

<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.ui.custom.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/bootstrap.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.uniform.js"></script>
<!--<script src="https://wahyuabsensi.gunungmas-seluler.com/js/select2.min.js"></script>-->
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.dataTables.min.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/matrix.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/matrix.tables.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/bootstrap-colorpicker.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/bootstrap-datepicker.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/masked.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/matrix.form_common.js"></script>
<script src="https://wahyuabsensi.gunungmas-seluler.com/js/jquery.peity.min.js"></script>

<?PHP } ?>

</body>
</html>
