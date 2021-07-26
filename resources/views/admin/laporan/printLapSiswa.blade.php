<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi</title>
</head>

<body>
    <table>
        <tr>
            <td style="width: 8rem">
                <center>
                    <img src="{{ public_path('img/logo.png') }}" height="70px" alt="">
                </center>
            </td>
            <td>
                <center>
                    <h3 style="height: 2px">
                        AN-NUR PADANG
                    </h3>
                    <p style="height: 2px">
                        Jln. Adinegoro No.24 A Kel. Batang Kabung Ganting, Kec. Koto Tangah
                    </p>
                    <p>
                        Kota Padang
                    </p>
                </center>
            </td>
        </tr>
    </table>

    <hr>
    <br>
    <center>Laporan Absensi Per Siswa</center>
    <table>
        <tr>
            <td style="width: 4rem"></td>
            <td style="width: 7rem">Nama</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$siswa->nama}}</td>
        </tr>
         <tr>
            <td style="width: 4rem"></td>
            <td style="width: 7rem">NISN</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$siswa->nisn}}</td>
        </tr>
        <tr>
            <td style="width: 4rem"></td>
            <td style="width: 7rem">Mata Pelajaran</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$jadwal->mapel->nama_mapel}}</td>
        </tr>
        <tr>
            <td style="width: 4rem"></td>
            <td style="width: 6rem">Kelas</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$jadwal->kelas->kelas}}</td>
        </tr>
        <tr>
            <td style="width: 4rem"></td>
            <td style="width: 6rem">Tahun Ajaran</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$jadwal->tahun_ajar}}</td>
        </tr>
        <tr>
            <td style="width: 4rem"></td>
            <td style="width: 6rem">Guru</td>
            <td style="width: 1rem">:</td>
            <td style="width: 1rem">{{$jadwal->guru->nama}}</td>
        </tr>
    </table>
    <br>

    <table style="border: 1px solid black;border-collapse: collapse;width: 95%" align="center" cellpadding="4">
        <thead style="border: 1px solid black">
            <tr >
                <th style="border: 1px solid black" class="text-center">No</th>
                <th style="border: 1px solid black" class="text-center">Pertemuan Ke</th>
                <th style="border: 1px solid black" class="text-center">Hadir</th>
                <th style="border: 1px solid black" class="text-center">Tidak Hadir</th>
                <th style="border: 1px solid black" class="text-center">Izin</th>
                <th style="border: 1px solid black" class="text-center">Sakit</th>
                <th style="border: 1px solid black" class="text-center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($absens as $absen)
            <tr>
                <td style="border: 1px solid black">{{$no++}}</td>
                <td style="border: 1px solid black">{{$absen->absensi->pertemuan}}</td>
                @if ($absen->status_kehadiran == 'Hadir')
                <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black">{{$absen->ket}}</td>
                @elseif($absen->status_kehadiran == 'Tidak Hadir')
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black">{{$absen->ket}}</td>
                @elseif($absen->status_kehadiran == 'Izin')
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black">{{$absen->ket}}</td>
                @elseif($absen->status_kehadiran == 'Sakit')
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                <td style="border: 1px solid black">{{$absen->ket}}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br>
    <table >
        <tr>
            <td style="width: 34rem">
            </td>
            <td style="width: 55rem">
                    Padang, {{date('d/m/Y')}}
                    <br>
                    &nbsp;&nbsp;Kepala Madrasah
                    <br>
                    <br>
                    <br>
                    <br>
                    &nbsp;&nbsp;<u> Dra. Hj. Marlina </u>
            </td>
        </tr>
    </table>
</body>

</html>
