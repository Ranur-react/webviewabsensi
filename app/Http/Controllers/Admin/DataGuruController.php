<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

use App\Guru;

class DataGuruController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dataGuru.index');
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
            'min' => ':attribute minimal :min karakter.',
            'unique' => ':attribute sudah digunakan.'
        ];
        $this->validate($request,[
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:gurus',
            'password' => 'required|min:6'
        ],$pesanErorr);

        $data = new Guru;
        $data ->nama = ucfirst( $request->nama);
        $data ->email = $request->email;
        $data ->password = bcrypt($request->password);
        $data ->remember_token = str_random(60);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guru::destroy($id);

        return response()->json([
            'success' => true
        ]);
    }

    public function apiDataGuru()
    {   
        $data = Guru::all();

        return DataTables::of($data)     
        ->addColumn('action', function($data){
        return '<a onClick="deleteForm('.$data->id.')" class="btn btn-danger btn-sm" >
                <i class="fa fa-trash-o" aria-hidden="true">&nbsp;  </i></a>';    
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    
    }
}
