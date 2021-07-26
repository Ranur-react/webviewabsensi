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

class AbsensiController extends Controller
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
        return view('guru.absensi.index');
    }
    public function apiAbsensi()
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
                return '<a href="/guru/absensi-detail/' . $data->id . '" class="btn btn-primary btn-sm" >
                <i class="fa fa-eye" aria-hidden="true"></i></a> ';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
