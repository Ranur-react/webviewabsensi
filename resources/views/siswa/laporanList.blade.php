@extends('layouts.appSiswa')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/siswa')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">laporan</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Laporan  Absensi</h1>
    </div>
    
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Daftar Mata Pelajaran
            </div>
            
            <div class="panel-body">
                <div class="col-md-12 table-responsive">
                    <table id="table-laporan-list" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Mata Pelajaran</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Jam Mulai</th>
                                <th class="text-center">Absen</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach ($datas as $data)
                                <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data->mapel->nama_mapel}}</td>
                                <td>{{$data->hari}}</td>
                                <td>{{$data->jam}}</td>
                                <td>
                                <a href="/siswa/laporan/{{$data->id}}" class="btn btn-primary btn-sm" >
                                        <i class="fa fa-print" aria-hidden="true"></i></a> 
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.panel-->
    </div><!-- /.col-->
@endsection
@section('js')
{{-- <script type="text/javascript">
$(document).ready(function() {
    var table = $('#table-laporan-list').dataTable({
        processing: false,
        serverSide: false,
        scrollY: false,
        scrollX: true,
        scrollapse : true,
        bDestroy: true,
        touppercase:true,
        ajax:"{{route('api.laporan.list')}}",
            columns:[
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'mapel', name : 'nama_mapel'},
            {data: 'hari', name : 'hari'},
            {data: 'jam', name : 'jam'},
            {data: 'action', name : 'action', orderable : false, searchable : false, render : false}
            ]
        });
    });
</script> --}}
@endsection