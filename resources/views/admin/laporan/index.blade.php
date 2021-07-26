@extends('layouts.appAdmin')
@section('content')


<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">laporan</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Laporan</h1>
    </div>

</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default table-responsive">
            <div class="panel-heading">Mata Pelajaran
            </div>
            <table id="table-jadwal-mapel" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                <thead style="background-color: #30A5FF">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Mata Pelajaran</th>
                        <th class="text-center">Guru</th>
                        <th class="text-center">Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=0;
                    @endphp
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{$jadwals->firstItem()+$no++}}</td>
                            <td>{{$jadwal->kelas->kelas}}</td>
                            <td>{{$jadwal->mapel->nama_mapel}}</td>
                            <td>{{!empty($jadwal->guru) ? $jadwal->guru->nama:''}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{url('admin/print-mapel')}}/{{$jadwal->id}}">
                                <i class="fa fa-eye"> Lihat Absensi</i>
                            </a>
                            <a class="btn btn-primary btn-sm" href="{{url('admin/list-siswa')}}/{{$jadwal->kelas_id}}/{{$jadwal->id}}">
                                <i class="fa fa-eye"> Lihat Siswa</i>
                            </a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="ml-2">
                {{$jadwals->links()}}
            </div>
        </div><!-- /.panel-->
    </div><!-- /.col-->
</div>

@endsection
@section('js')

@endsection
