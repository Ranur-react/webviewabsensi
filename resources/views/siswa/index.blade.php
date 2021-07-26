@extends('layouts.appSiswa')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/siswa')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Profil</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profil Siswa</h1>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Profil</div>
            <div class="panel-body">
                <center>
                    @if ($siswa->foto == null)
                    <img src="{{asset('img/user.jpg')}}" style="height: 250px" alt="">
                    @else
                    <img src="{{url($siswa->foto)}}" width="300" heigth="500" alt="">
                    @endif
                </center>
                <br>
                <table style="font-size: 12pt" class="table" >
                    <tr>
                        <td style="width: 20rem">Nama</td>
                        <td style="width: 2rem">:</td>
                        <td>{{$siswa->nama}}</td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td>{{$siswa->nisn}}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>
                            @if ($siswa->kelas_id == null)
                            @else
                            {{$siswa->kelas->kelas}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{$siswa->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td >Tempat Tanggal lahir</td>
                        <td>:</td>
                        <td>{{$siswa->tempat_lahir}}, {{$siswa->tgl_lahir}}</td>
                    </tr>
                    
                    <tr>
                        <td>Nama Ibu Kandung</td>
                        <td>:</td>
                        <td>{{$siswa->nama_ibu_kandung}}</td>
                    </tr>
                </table>
                <hr>
                <div class="pull-right"> 
                    <a onClick="editForm()" type="button" class="btn btn-primary btn-md"><i class="fa fa-pencil"> Edit Profil</i></a>           
                </div>
            </div>
        </div><!-- /.panel-->
        @include('siswa.editForm')
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">
    function editForm(){
        save_method = "add";
        $('input[name =_method]').val('POST');
        $('#modal-edit').modal('show');  
        $('.modal-judul').text('Edit Profil'); 
        $('#modal-edit form')[0].reset(); 
        }

</script>
@endsection