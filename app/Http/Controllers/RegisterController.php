<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Siswa;

class RegisterController extends Controller
{
    public function index()
    {
        return view('authSiswa.register');
    }
    
    public function post(Request $request)
    {
        $pesanErorr =[
            'required' => ':attribute harus di isi.',
            'unique' => ':attribute sudah digunakan.',
            'min' => ':attribute harus 6 karakter.',
        ];
        $this->validate($request,[
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswas',
            'password' => 'required|string|min:6|confirmed',
        ],$pesanErorr);
        
        $data= new Siswa;
        $data->nama=$request->nama;
        $data->email=$request->email;
        $data->password=Hash::make($request->password);
        $data->kelas_id = 1;
        $data->save();

        return redirect(url('/siswa/login'));
    }
}
