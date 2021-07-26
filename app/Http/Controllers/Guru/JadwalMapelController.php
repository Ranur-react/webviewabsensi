<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Jadwal_mapel;
use App\Kelas;
use App\Guru;
use App\Mapel;

class JadwalMapelController extends Controller
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
        $kelass = Kelas::get();
        $mapels = Mapel::get();

        return view('guru.jadwalMapel.index', compact('kelass', 'mapels'));
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
            'kelas' => 'required',
            'mapel' => 'required',
            'jam' => 'required|string|min:4|max:5',
            'TA' => 'required|string|min:9|max:9',
        ], $pesanErorr);

        $data = new Jadwal_mapel;
        $data->kelas_id = $request->kelas;
        $data->mapel_id = $request->mapel;
        $data->guru_id = Auth::guard('guru')->user()->id;
        $data->jam = $request->jam;
        $data->hari = $request->hari;
        $data->tahun_ajar = $request->TA;
        $data->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Jadwal_mapel::find($id);
        return $data;
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
        $data = Jadwal_mapel::find($id);
        $data->kelas_id = $request->kelas_edit;
        $data->mapel_id = $request->mapel_edit;
        $data->jam = $request->jam_edit;
        $data->hari = $request->hari_edit;
        $data->tahun_ajar = $request->TA_edit;
        $data->update();

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
        Jadwal_mapel::destroy($id);

        return response()->json([
            'success' => true
        ]);
    }

    public function apiJadwalMapel()
    {
        $data = Jadwal_mapel::with('kelas')->with('mapel')->with('guru')
            ->whereGuruId(Auth::guard('guru')->user()->id);

        return DataTables::of($data)
            ->editColumn('kelas', function ($data) {
                return $data->kelas->kelas;
            })
            ->editColumn('mapel', function ($data) {
                return $data->mapel->nama_mapel;
            })
            ->addColumn('action', function ($data) {
                return '<a onClick="editForm(' . $data->id . ')" class="btn btn-primary btn-sm" >
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> ' .
                    '<a onClick="deleteForm(' . $data->id . ')" class="btn btn-danger btn-sm" >
                        <i class="fa fa-trash-o" aria-hidden="true">&nbsp;  </i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
