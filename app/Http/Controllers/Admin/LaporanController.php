<?php

namespace App\Http\Controllers\Admin;

use PDF;

use App\Absensi_detail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Jadwal_mapel;
use App\Siswa;
use App\Absensi;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $jadwals = Jadwal_mapel::paginate(10);

        return view('admin.laporan.index', compact('jadwals'));
    }

    public function printPerMapel($mapelid)
    {

        $datas = Absensi_detail::whereJadwalMapelId($mapelid)->get();
        $jadwal_mapel = Jadwal_mapel::find($mapelid);
        $jumlah_pertemuan = Absensi::whereJadwalMapelId($jadwal_mapel->id)->count();
        $siswas = Siswa::whereKelasId($jadwal_mapel->kelas_id)->get();
        // // dd($siswa_id);
        return PDF::loadView('admin.laporan.printPerMapel', [
            'datas' => $datas, 'jadwal_mapel' => $jadwal_mapel,
            'jumlah_pertemuan' => $jumlah_pertemuan,
            'siswas' => $siswas,
        ])->stream();
    }

    public function listSiswa($kelasId, $jadwalId)
    {
        // ambil siswa
        $siswas = Siswa::whereKelasId($kelasId)->get();
        $jadwal = Jadwal_mapel::find($jadwalId);

        return view('admin.laporan.listSiswa', compact('siswas', 'jadwal'));
    }

    public function printPerSiswa($siswaId, $jadwalId)
    {
        // data siswa
        $siswa = Siswa::find($siswaId);
        // data jadwal mapel
        $jadwal = Jadwal_mapel::find($jadwalId);
        // ambil data dari absensi detail
        $absens = Absensi_detail::whereSiswaId($siswaId)->whereJadwalMapelId($jadwalId)->get();

        return PDF::loadView('admin.laporan.printLapSiswa', [
            'jadwal' => $jadwal,
            'absens' => $absens,
            'siswa' => $siswa
        ])->stream();
    }
}
