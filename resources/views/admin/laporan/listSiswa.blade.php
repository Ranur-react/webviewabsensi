@extends('layouts.appAdmin')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Laporan</li>
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
            <div class="panel-heading"> Laporan Per Siswa
            </div>
            <br>
            <table class="table-responsive">
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Kelas</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal->kelas->kelas}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Mapel</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal->mapel->nama_mapel}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Hari</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal->hari}}</td>
                </tr>
            </table>

            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-absensi" class="table table-bordered table-striped dataTable table-responsive" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Siswa</th>
                                <th class="text-center">Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=0;
                            @endphp
                        @foreach ($siswas as $siswa)
                            @php
                                $no++;
                            @endphp
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$siswa->nama}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{url('/admin/print-persiswa')}}/{{$siswa->id}}/{{$jadwal->id}}">
                                        <i class="fa fa-eye"> Lihat</i>
                                    </a>
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

@endsection
