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
        <div class="panel panel-default table-responsive">
            <div class="panel-heading">Absensi
                <div class="pull-right">
                    <a onClick="addForm()" type="button" class="btn btn-primary btn-sm">Tambah Pertemuan</a>
                </div>
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
                    <table id="table-absensi" class="table table-bordered table-striped dataTable table-responsive" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">Pertemuan Ke</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($absensis as $absen)
                            <tr>
                                <td>{{$absen->pertemuan}}</td>
                                <td>{{$absen->tanggal}}</td>
                                <td>
                                    @if ($absen->status == 'off')
                                    <a onClick="mulai({{$absen->id}})" class="btn btn-primary btn-sm" >
                                        Mulai </a>
                                    @elseif($absen->status == 'on')
                                    <a onClick="selesai({{$absen->id}})" class="btn btn-danger btn-sm" >
                                        Selesai </a>
                                    @else
                                    <a href="{{url('/guru/absensi-detail/lihat')}}/{{$absen->id}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat Absen</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.panel-->
        @include('guru.absensiDetail.add')
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">

    function addForm(){
        save_method = "add";
        $('input[name =_method]').val('POST');
        $('#modal-add').modal('show');
        $('.modal-judul').text('Tambah Pertemuan');
        $('#modal-add form')[0].reset();
        }

    $('#simpan').click(function(event){
        event.preventDefault();

        var form = $('#modal-body form'),
            url = form.attr('action'),
            method = $('input[name=_method]').val();

            form.find('.help-block').remove();
            form.find('.form-group').removeClass('has-error');

        $.ajax ({
            url : url,
            method : method,
            data : form.serialize(),
            success:function(response){
                $('#modal-body form')[0].reset();
                $('#modal-add').modal('hide');
                location.reload();

                swal({
                    type : 'success',
                    title : 'Success!',
                    text : 'Data Berhasil Disimpan'
                });
            },
            error : function(xhr){
                var res = xhr.responseJSON;

                if ($.isEmptyObject(res) == false){
                    $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
                }

            }
        })
    });

    //Date picker
    var dateToday = new Date();
    $('#datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        immediateUpdates: true,
        todayBtn: true,
        todayHighlight: true,
        startDate: dateToday
    }).datepicker("setDate", "0");

    //Date picker Status
    $('#datepicker_status').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
    })
    //Date picker2 Status
    $('#datepicker2_status').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
    })
    //Date picker3 Status
    $('#datepicker3_status').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true
    })

    // tombol memulai pengisian absen
    function mulai(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Mulai !',
            text: "Anda Yakin Memulai Pengisian Absen",
            type: 'info',
            showCancelButton:true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Mulai',

        }).then(function(){
            $.ajax({
            url : "{{url ('guru/absensi-detail')}}"+'/'+id,
            type : "POST",
            data : {'_method':'Patch','_token':csrf_token},
            success : function(data){
                location.reload()
                swal({
                title: 'Success!',
                text: 'Siswa Sudah Bisa Memulai Pengisian Absen !',
                type: 'success',
                timer: '3000'
                })
            },
            error : function (){
                location.reload()
                swal({
                title: 'Success!',
                text: 'Siswa Sudah Bisa Memulai Pengisian Absen !',
                type: 'success',
                timer: '6000'
            })
            }
            });
        });
    }

    // tombol selesai pengisian absen
    function selesai(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Selesai !',
            text: "Anda Yakin Mengakhiri Pengisian Absen",
            type: 'warning',
            showCancelButton:true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Selesai',

        }).then(function(){
            $.ajax({
            url : "{{url ('guru/absensi-detail/selesai')}}"+'/'+id,
            type : "POST",
            data : {'_method':'post','_token':csrf_token},
            success : function(data){
                location.reload()
                swal({
                title: 'Success!',
                text: 'Pengisian Absensi Telah Berakhir !',
                type: 'success',
                timer: '3000'
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
