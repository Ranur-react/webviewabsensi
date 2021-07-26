<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi {{$absensi->mapel->nama_mapel}}</title>
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
        <center>Laporan Absensi Per Pertemuan</center>
        <table>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 7rem">Mata Pelajaran</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$absensi->mapel->nama_mapel}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Kelas</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$absensi->kelas->kelas}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Tanggal</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$absensi->tanggal}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Pertemuan Ke</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$absensi->pertemuan}}</td>
            </tr>
            <tr>
                <td style="width: 4rem"></td>
                <td style="width: 6rem">Guru</td>
                <td style="width: 1rem" >:</td>
                <td style="width: 1rem">{{$absensi->guru->nama}}</td>
            </tr>
        </table>
        <br>

        <table style="border: 1px solid black;border-collapse: collapse;width: 95%" align="center" cellpadding="4">
            <thead style="border: 1px solid black">
                <tr >
                    <th style="border: 1px solid black" class="text-center">No</th>
                    <th style="border: 1px solid black" class="text-center">Siswa</th>
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
                @foreach ($kehadiran as $hadir)
                <tr>
                    <td style="border: 1px solid black">{{$no++}}</td>
                    <td style="border: 1px solid black">{{$hadir->siswa->nama}}</td>
                    @if ($hadir->status_kehadiran == 'Hadir')
                    <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{$hadir->ket}}</td>
                    @elseif($hadir->status_kehadiran == 'Tidak Hadir')
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{$hadir->ket}}</td>
                    @elseif($hadir->status_kehadiran == 'Izin')
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black">{{$hadir->ket}}</td>
                    @elseif($hadir->status_kehadiran == 'Sakit')
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"></td>
                    <td style="border: 1px solid black"><div style="font-family: DejaVu Sans, sans-serif;">✔</div></td>
                    <td style="border: 1px solid black">{{$hadir->ket}}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>
