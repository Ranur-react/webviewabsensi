@extends('layouts.appGuru')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Lihat absensi</li>
    </ol>
    <div class="panel-heading"> Kelola Absensi
        <div class="pull-right">
            <a href="{{url('/guru/print')}}/{{$absensi->id}}" type="button" class="btn btn-primary btn-sm">Print</a>
        </div>
    </div>
</div>
<!--/.row-->

<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default table-responsive">

            <br><center><h3>MTs.S AN-NUR PADANG</h3>
            <h5>Jln. Adinegoro No.24 A Kel. Batang Kabung Ganting, Kec. Koto Tangah</h5>
            <h5>Kota Padang</h5>
            <hr></center>
            <br>
            <table class="table-responsive">
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Kelas</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$absensi->kelas->kelas}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Mapel</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$absensi->mapel->nama_mapel}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Tanggal</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$absensi->tanggal}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 12rem">Pertemuan Ke</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$absensi->pertemuan}}</td>
                </tr>
            </table>

            <div class="panel-body">
                <div class="col-md-12 table-responsive">
                    <table id="table-absensi" class="table table-bordered table-striped dataTable table-responsive" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Siswa</th>
                                <th class="text-center">Hadir</th>
                                <th class="text-center">Tidak Hadir</th>
                                <th class="text-center">Izin</th>
                                <th class="text-center">Sakit</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($kehadiran as $hadir)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$hadir->siswa->nama}}</td>
                                @if ($hadir->status_kehadiran == 'Hadir')
                                <td><i class="fa fa-check"></i></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @elseif($hadir->status_kehadiran == 'Tidak Hadir')
                                <td></td>
                                <td><i class="fa fa-check"></i></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @elseif($hadir->status_kehadiran == 'Izin')
                                <td></td>
                                <td></td>
                                <td><i class="fa fa-check"></i></td>
                                <td></td>
                                <td></td>
                                @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><i class="fa fa-check"></i></td>
                                <td></td>
                                @endif
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
