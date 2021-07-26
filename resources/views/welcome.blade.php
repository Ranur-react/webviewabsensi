@extends('layouts.app')
@section('content')

<div class="content">
    <div class="title m-b-md">
        Absensi Online Berbasis Android WebView
    </div>

    <div class="links">
        <a href="{{route('admin.beranda')}}">admin Login</a>
        <a href="{{route('guru.beranda')}}">guru Login</a> <br>
        <a href="{{route('siswa.beranda')}}">siswa Login</a>
    </div>
</div>

@endsection


