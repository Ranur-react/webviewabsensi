<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use PDF;

use App\Siswa;
use App\Kelas;
use App\Absensi;
use App\Absensi_detail;
use App\Jadwal_mapel;

class SiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:siswa');
    }

    public function index()
    {
        $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
        $kelass = Kelas::all();
        // return view('siswa.index',compact('siswa','kelass'));
        return view('siswa.index', ['siswa' => $siswa, 'kelas' => $kelass]);
    }

    public function editPost(Request $request)
    {

        $input = $request->all();
        $input['foto'] = null;

        if ($request->hasFile('foto')) {
            $input['foto'] = '/img/' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('img'), $input['foto']);
        }
        // dd($input);
        Siswa::find(Auth::guard('siswa')->user()->id)->update($input);
        Alert::success('Profil Telah Di Update', 'Terimaksih');
        return redirect(url('/siswa'));
    }



    public function mapelList()
    {
        $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
        if ($siswa->kelas == null) {
            Alert::warning('Silahkan Edit Profil Terlebih Dahulu', 'Terimaksih');
            return redirect(url('/siswa'));
        } else {
            // return view('siswa.mapelList', compact('mapels'));
            return view('siswa.mapelList', ['siswa' => $siswa]);
        }
    }

    public function apiMapelList()
    {
        $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
        $data = Jadwal_mapel::whereKelas_id($siswa->kelas_id)->with('kelas')->with('mapel')->with('guru');

        return DataTables::of($data)
            ->editColumn('mapel', function ($data) {
                return $data->mapel->nama_mapel;
            })
            ->addColumn('action', function ($data) {
                return '<a href="/siswa/absen-list/' . $data->id . '" class="btn btn-primary btn-sm" >
                <i class="fa fa-eye" aria-hidden="true"></i></a> ';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function absenlist($id)
    {
        $jadwal_mapels = Jadwal_mapel::find($id);
        $absensis = Absensi::whereJadwal_mapel_id($id)->get();
        return view('siswa.absenList', compact('jadwal_mapels', 'absensis'));
    }

    public function isiabsen(Request $request)
    {
        $pesanErorr = [
            'required' => ':attribute harus di isi.',
            'string' => ':attribute hanya menggunakan huruf.',
            'integer' => ':attribute hanya menggunakan angka.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah digunakan.'
        ];
        $this->validate($request, [
            // |string|max:255|unique:users,email
            'status_kehadiran.*' => 'required',
        ], $pesanErorr);

        $absensi_id = $request->absensi_id;
        $siswa_id = $request->siswa_id;
        Absensi_detail::whereAbsensi_id($absensi_id)->whereSiswa_id($siswa_id)->update(['status_kehadiran' => $request->status_kehadiran]);
        Alert::success('Absen Telah diIsi Status Kehadiran ' . $request->status_kehadiran, 'Terimaksih');
        return back();
    }

    public function laporanlist()
    {
        $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
        if ($siswa->kelas == null) {
            Alert::warning('Silahkan Edit Profil Terlebih Dahulu', 'Terimaksih');
            return redirect(url('/siswa'));
        } else {
            $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
            $datas = Jadwal_mapel::whereKelas_id($siswa->kelas_id)->get();
            return view('siswa.laporanList', compact('datas'));
        }
    }
    public function laporanPrint($id)
    {
        $siswa = Siswa::find(Auth::guard('siswa')->user()->id);
        $datas = Absensi_detail::whereSiswa_id($siswa->id)->whereJadwal_mapel_id($id)->get();
        $jadwal_mapel = Jadwal_mapel::find($id);

        // dd($siswa_id);
        return PDF::loadView('siswa.print', ['siswa' => $siswa, 'jadwal_mapel' => $jadwal_mapel, 'datas' => $datas])->stream();
    }
}
