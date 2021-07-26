@extends('layouts.appGuru')
@section('content')


<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">laporan-persiswa</li>
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
        <div class="panel panel-default">
            <div class="panel-heading">Per Siswa
            </div>
            <table id="table-jadwal-mapel" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                <thead style="background-color: #30A5FF">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Mata Pelajaran</th>
                        <th class="text-center">Absensi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=0;
                    @endphp
                    @foreach ($jadwals as $jadwal)
                        @php
                            $no++
                        @endphp
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$jadwal->kelas->kelas}}</td>
                            <td>{{$jadwal->mapel->nama_mapel}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{url('guru/lihat-lap-persiswa')}}/{{$jadwal->kelas_id}}">
                                <i class="fa fa-eye"> Lihat Siswa</i>
                            </a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div><!-- /.panel-->
    </div><!-- /.col-->
</div>

@endsection
@section('js')

@endsection
