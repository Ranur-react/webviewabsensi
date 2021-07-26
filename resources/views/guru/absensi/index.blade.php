@extends('layouts.appGuru')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">absensi</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Absensi</h1>
    </div>
    
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Kelola Absensi
            </div>
            
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-absensi" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Mata Pelajaran</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Jam Mulai</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </div>
        </div><!-- /.panel-->
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#table-absensi').dataTable({
        processing: false,
        serverSide: false,
        scrollY: false,
        scrollX: true,
        scrollapse : true,
        bDestroy: true,
        touppercase:true,
        ajax:"{{route('api.absensi')}}",
            columns:[
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'kelas', name : 'kelas'},
            {data: 'mapel', name : 'nama_mapel'},
            {data: 'hari', name : 'hari'},
            {data: 'jam', name : 'jam'},
            {data: 'action', name : 'action', orderable : false, searchable : false, render : false}
            ]
        });
    });
</script>
@endsection