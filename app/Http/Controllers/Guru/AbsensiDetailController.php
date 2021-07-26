<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Alert;

use App\Jadwal_mapel;
use App\Kelas;
use App\Siswa;
use App\Guru;
use App\Mapel;
use App\Absensi;
use App\Absensi_detail;
class AbsensiDetailController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pesanErorr =[
            'required' => ':attribute harus di isi.',
            'string' => ':attribute hanya menggunakan huruf.',
            'integer' => ':attribute hanya menggunakan angka.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
            'unique' => ':attribute sudah digunakan.'
        ];
        $this->validate($request,[
            // |string|max:255|unique:users,email
            'pertemuan' => 'required|integer|max:30',
            'tanggal' => 'required',
        ],$pesanErorr);

        $siswas = Siswa::whereKelas_id($request->kelas_id)->get();
        if($siswas->isEmpty()){
            Alert::error('Tidak ada siswa dalam kelas','Daftarkan siswa ke kelas terlebih dulu');
            return back();
        }else{
        $data = new Absensi;
        $data ->pertemuan = $request->pertemuan;
        $data ->tanggal = $request->tanggal;
        $data ->jadwal_mapel_id = $request->jadwal_mapel_id;
        $data ->guru_id = $request->guru_id;
        $data ->kelas_id = $request->kelas_id;
        $data ->mapel_id = $request->mapel_id;
        $data ->status = 'off';
        $data->save();

        
        foreach ($siswas as $siswa) {

            $dataAbsenDetail[] = array(
                
                'siswa_id'   => $siswa->id,
                'absensi_id'   => $data->id,
                'jadwal_mapel_id' => $data->jadwal_mapel_id,
                'status_kehadiran'   => '-',
                'ket'    => null,

                
            );
        }
        Absensi_detail::insert($dataAbsenDetail);
    }


        return response()->json([
            'success' => true
        ]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $jadwal_mapels = Jadwal_mapel::find($id);
        $absensis = Absensi::whereJadwal_mapel_id($id)->get();
        return view('guru.absensiDetail.index',compact('jadwal_mapels','absensis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mulai = Absensi::find($id);
        $mulai->status = 'on';
        $mulai->save();

        $absensis = Siswa::whereAbsensi_id($id)->whereStatus_kehadiran('-')->get();
        foreach ($absensis as $absensi) {

            $dataAbsenDetail[] = array(
                
                'status_kehadiran'   => 'Tidak Hadir',
                'ket'    => null,

                
            );
        }
        Absensi_detail::insert($dataAbsenDetail);

        return response()->json([
            'success' => true
        ]);
    }
    public function updateSelesai(Request $request, $id)
    {
        $mulai = Absensi::find($id);
        $mulai->status = 'selesai';
        $mulai->save();

        Absensi_detail::whereAbsensi_id($id)->whereStatus_kehadiran('-')->update(['status_kehadiran'=>'Tidak Hadir']);
        
        // $data = Absensi::find($id);
        // $data->status = 'selesai';
        // $data->save();
        
        // $siswas = Siswa::whereKelas_id(9)->get();

        // foreach ($siswas as $siswa) {
        
        // $data = Absensi::find($id);
        // $dataAbsenDetail[] = array(
        
        //     'siswa_id'   => $siswa->id,
        //     'absensi_id'   => $data->id,
        //     'jadwal_mapel_id' => $data->jadwal_mapel_id,
        //     'status_kehadiran'   => 'Hadir',
        //     'ket'    => null,
        
        
        //      );
        // }
        // Absensi_detail::insert($dataAbsenDetail);

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lihat($id)
    {
        $absensi = Absensi::find($id);
        $kehadiran = Absensi_detail::whereAbsensi_id($id)->get();

        return view('guru.absensiDetail.lihatAbsen',compact('absensi','kehadiran'));
    }

    public function print($id)
    {
        $absensi = Absensi::find($id);
        $kehadiran = Absensi_detail::whereAbsensi_id($id)->get();

        return PDF::loadView('guru.absensiDetail.print',['absensi'=>$absensi,'kehadiran'=>$kehadiran])->stream();
    }

}
