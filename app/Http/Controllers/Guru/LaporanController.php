<?php

namespace App\Http\Controllers\Guru;

use App\Absensi;
use App\Absensi_detail;
use App\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jadwal_mapel;
use App\Mapel;
use App\Siswa;
use PDF;

use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:guru');
    }

    public function perMapel()
    {
        $guru = Guru::find(Auth::guard('guru')->user()->id);
        $jadwals = Jadwal_mapel::whereGuruId($guru->id)->get();
        return view('guru.laporan.perMapel', compact('jadwals'));
    }
    public function lihatPrintPerMapel($mapelid)
    {

        $datas = Absensi_detail::whereJadwalMapelId($mapelid)->get();
        $jadwal_mapel = Jadwal_mapel::find($mapelid);
        $jumlah_pertemuan = Absensi::whereJadwalMapelId($jadwal_mapel->id)->count();
        $siswas = Siswa::whereKelasId($jadwal_mapel->kelas_id)->get();
        // // dd($siswa_id);
        return PDF::loadView('guru.laporan.printPerMapel', [
            'datas' => $datas, 'jadwal_mapel' => $jadwal_mapel,
            'jumlah_pertemuan' => $jumlah_pertemuan,
            'siswas' => $siswas,
        ])->stream();
    }
    public function lihatLapPerSiswa($kelasId, $jadwalId)
    {
        // ambil siswa
        $siswas = Siswa::whereKelasId($kelasId)->get();
        $jadwal = Jadwal_mapel::find($jadwalId);

        return view('guru.laporan.lihatSiswa', compact('siswas', 'jadwal'));
    }
    public function printLapSiswa($siswaId, $jadwalId)
    {
        // data siswa
        $siswa = Siswa::find($siswaId);
        // data jadwal mapel
        $jadwal = Jadwal_mapel::find($jadwalId);
        // ambil data dari absensi detail
        $absens = Absensi_detail::whereSiswaId($siswaId)->whereJadwalMapelId($jadwalId)->get();

        return PDF::loadView('guru.laporan.printLapSiswa', [
            'jadwal' => $jadwal,
            'absens' => $absens,
            'siswa' => $siswa
        ])->stream();
    }
}
