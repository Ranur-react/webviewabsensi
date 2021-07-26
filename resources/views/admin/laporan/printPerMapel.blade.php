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
            <td><center><h3 style="height: 2px">
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
        <center>Rekap Absensi Per Mata Pelajaran</center>
        <table>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 7rem">Mata Pelajaran</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$jadwal_mapel->mapel->nama_mapel}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Kelas</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$jadwal_mapel->kelas->kelas}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Jumlah Pertemuan</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$jumlah_pertemuan}} dari 30</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Tahun Ajaran</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$jadwal_mapel->tahun_ajar}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Guru</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$jadwal_mapel->guru->nama}}</td>
            </tr>
        </table>
        <br>

        <table style="border: 1px solid black;border-collapse: collapse;width: 95%" align="center" cellpadding="4">
            <thead style="border: 1px solid black">
                <tr >
                    <th style="border: 1px solid black" class="text-center">No</th>
                    <th style="border: 1px solid black" class="text-center">NISN</th>
                    <th style="border: 1px solid black" class="text-center">Nama Siswa</th>
                    <th style="border: 1px solid black" class="text-center">Hadir</th>
                    <th style="border: 1px solid black" class="text-center">Tidak Hadir</th>
                    <th style="border: 1px solid black" class="text-center">Izin</th>
                    <th style="border: 1px solid black" class="text-center">Sakit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($siswas as $siswa)
                <tr>
                    <td style="border: 1px solid black">{{$no++}}</td>
                    <td style="border: 1px solid black">{{$siswa->nisn}}</td>
                    <td style="border: 1px solid black">{{$siswa->nama}}</td>
                    @php
                        $hadir = App\Absensi_detail::whereJadwalMapelId($jadwal_mapel->id)->whereSiswaId($siswa->id)
                        ->whereStatusKehadiran('Hadir')->count();
                        $tidakHadir = App\Absensi_detail::whereJadwalMapelId($jadwal_mapel->id)->whereSiswaId($siswa->id)
                        ->whereStatusKehadiran('Tidak Hadir')->count();
                        $izin = App\Absensi_detail::whereJadwalMapelId($jadwal_mapel->id)->whereSiswaId($siswa->id)
                        ->whereStatusKehadiran('Izin')->count();
                        $sakit = App\Absensi_detail::whereJadwalMapelId($jadwal_mapel->id)->whereSiswaId($siswa->id)
                        ->whereStatusKehadiran('Sakit')->count();
                    @endphp
                    @if ($hadir !== 0)
                    <td style="border: 1px solid black">{{$hadir}}</td>
                    @else
                        <td style="border: 1px solid black">-</td>
                    @endif
                    @if ($tidakHadir !== 0)
                        <td style="border: 1px solid black">{{$tidakHadir}}</td>
                    @else
                        <td style="border: 1px solid black">-</td>
                    @endif
                    @if ($izin !== 0)
                        <td style="border: 1px solid black">{{$izin}}</td>
                    @else
                        <td style="border: 1px solid black">-</td>
                    @endif
                    @if ($sakit !== 0)
                        <td style="border: 1px solid black">{{$sakit}}</td>
                    @else
                        <td style="border: 1px solid black">-</td>
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
                    &nbsp;&nbsp;&nbsp;<u>Dra. Hj. Marlina</u>
            </td>
        </tr>
    </table>
</body>
</html>
