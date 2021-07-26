<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

use App\Admin;

class DataAdminController extends Controller
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
        return view('admin.dataAdmin.index');
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
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6'
        ],$pesanErorr);

        $dataadmin = new Admin;
        $dataadmin ->nama = ucfirst($request->nama);
        $dataadmin ->email = $request->email;
        $dataadmin ->password = bcrypt($request->password);
        $dataadmin ->remember_token = str_random(60);
        $dataadmin->save();

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
        Admin::destroy($id);

        return response()->json([
            'success' => true
        ]);
    }

    public function apiDataAdmin()
    {   
        $data = Admin::all();

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
