@extends('layouts.appAdmin')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">data-siswa</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Data Siswa</h1>
    </div>

</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Kelola Data Siswa
            </div>

            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-data-siswa" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NISN</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">Tempat Lahir</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Nama Ibu Kandung</th>
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
    var table = $('#table-data-siswa').dataTable({
        processing: false,
        serverSide: false,
        scrollY: false,
        scrollX: true,
        scrollapse : true,
        bDestroy: true,
        touppercase:true,
        ajax:"{{route('api.data.siswa')}}",
            columns:[
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'nama', name : 'nama'},
            {data: 'nisn', name : 'nisn'},
            {data: 'kelas', name : 'kelas'},
            {data: 'email', name : 'email'},
            {data: 'jenis_kelamin', name : 'jenis_kelamin'},
            {data: 'tempat_lahir', name : 'tempat_lahir'},
            {data: 'tgl_lahir', name : 'tgl_lahir'},
            {data: 'nama_ibu_kandung', name : 'nama_ibu_kandung'},
            {data: 'action', name : 'action', orderable : false, searchable : false, render : false}
            ]
        });
    });

    function deleteForm(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Anda Yakin?',
            text: "Anda Yakin Akan Menghapus Data?",
            type: 'warning',
            showCancelButton:true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Data ini!'
        }).then(function(){
            $.ajax({
            url : "{{url ('admin/data-siswa')}}"+'/'+id,
            type : "POST",
            data : {'_method':'delete','_token':csrf_token},
            success : function(data){
                $('#table-data-siswa').DataTable().ajax.reload()
                swal({
                title: 'Success!',
                text: 'Data Berhasil dihapus!',
                type: 'success',
                timer: '1500'
                })
            },
            error : function (){
            swal({
                title : 'Oopss',
                text : 'Ada Yang salah !',
                type : 'error',
                timer : '1500'
            })
            }
            });
        });
    }
</script>
@endsection
