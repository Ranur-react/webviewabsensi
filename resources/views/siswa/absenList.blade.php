@extends('layouts.appSiswa')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/siswa')}}">
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
        <div class="panel panel-default table-responsive">
            <div class="panel-heading"> Ambil Absen
            </div>
            <br>
            <table class="table-responsive">
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Kelas</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal_mapels->kelas->kelas}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Mapel</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal_mapels->mapel->nama_mapel}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Hari</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal_mapels->hari}}</td>
                </tr>
                <tr>
                    <td style="width: 4rem"></td>
                    <td style="width: 9rem">Jam Mulai</td>
                    <td style="width: 3rem" >:</td>
                    <td style="width: 6rem">{{$jadwal_mapels->jam}} WIB</td>
                </tr>
            </table>
            
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-absen" class="table table-bordered table-striped table-responsive"role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">Pertemuan Ke</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Ambil Absen</th>
                            </tr>
                        </thead> 
                        <tbody>
                        @foreach ($absensis as $absen)
                            <tr>
                                <td>{{$absen->pertemuan}}</td>
                                <td>{{$absen->tanggal}}</td>
                                <td>
                                    @php
                                        $sudah_absen = App\Absensi_detail::whereAbsensi_id($absen->id)->whereSiswa_id(Auth::guard('siswa')->user()->id)->first();
                                    @endphp
                                    @if ($absen->status == 'off')
                                    <button disabled="disabled" class="btn btn-primary btn-sm" ><i class="fa fa-pencil"> Ambil Absen</i></button>
                                    @elseif($absen->status == 'on')
                                    <a onClick="absen({{$absen->id}})" class="btn btn-primary btn-sm" >
                                        <i class="fa fa-pencil"> Isi Absen</i> </a>
                                    @else
                                        {{$sudah_absen->status_kehadiran}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.panel-->
        @include('siswa.formAmbilAbsen')
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">

    function absen(id){
        save_method = "add";
        $('input[name =_method]').val('POST');
        $('#modal-add').modal('show');  
        $('.modal-judul').text('Isi Absen'); 
        $('#modal-add form')[0].reset();
        $('#id').val(id);
        }
    
    // $('#simpan').click(function(event){
    //     event.preventDefault();

    //     var form = $('#modal-body form'),
    //         url = form.attr('action'),
    //         method = $('input[name=_method]').val();

    //         form.find('.help-block').remove();
    //         form.find('.form-group').removeClass('has-error');

    //     $.ajax ({
    //         url : url,
    //         method : method,
    //         data : form.serialize(),
    //         success:function(response){
    //             $('#modal-body form')[0].reset();
    //             $('#modal-add').modal('hide');
    //             location.reload();

    //             swal({
    //                 type : 'success',
    //                 title : 'Success!',
    //                 text : 'Data Berhasil Disimpan'
    //             });
    //         },
    //         error : function(xhr){
    //             var res = xhr.responseJSON;
                
    //             if ($.isEmptyObject(res) == false){
    //                 $.each(res.errors, function (key, value) {
    //                 $('#' + key)
    //                     .closest('.form-group')
    //                     .addClass('has-error')
    //                     .append('<span class="help-block"><strong>' + value + '</strong></span>');
    //             });
    //             }
                
    //         }
    //     })
    // });

</script>
@endsection