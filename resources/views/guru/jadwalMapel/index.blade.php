@extends('layouts.appGuru')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/guru')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">jadwal-mapel </li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Jadwal Mengajar</h1>
    </div>

</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"> Mata Pelajaran
                <div class="pull-right">
                    <a onClick="addForm()" type="button" class="btn btn-primary btn-sm">Tambah Data</a>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-jadwal-mapel" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
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
            @include('guru.jadwalMapel.addEditForm')
        </div><!-- /.panel-->
        @include('guru.jadwalMapel.editForm')
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#table-jadwal-mapel').dataTable({
        processing: false,
        serverSide: false,
        scrollY: false,
        scrollX: true,
        scrollapse : true,
        bDestroy: true,
        touppercase:true,
        ajax:"{{route('api.jadwal.mapel')}}",
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

    function addForm(){
        save_method = "add";
        $('input[name =_method]').val('POST');
        $('#modal-addEdit').modal('show');
        $('.modal-judul').text('Tambah Mata Pelajaran');
        $('#modal-addEdit form')[0].reset();
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
                $('#modal-addEdit').modal('hide');
                $('#table-jadwal-mapel').DataTable().ajax.reload();

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

function editForm(id){
    save_method = 'edit';
    $('input[name=_method]').val('PATCH');
    $('#modal-edit form')[0].reset();
    $.ajax({
    url : "{{ url('guru/jadwal-mapel')}}" + '/' + id + "/edit",
    type : "GET",
    dataType : "JSON",
    success : function (data){
        $('#modal-edit').modal('show');
        $('.modal-judul').text('Edit Jadwal Mata Pelajaran');

        $('#id1').val(data.id);;
        $('#kelas1').val(data.kelas_id);
        $('#mapel1').val(data.mapel_id);
        $('#hari1').val(data.hari);
        $('#jam1').val(data.jam);
        $('#TA1').val(data.tahun_ajar);
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
}

$(function(){
        $('#modal-edit form').on('submit', function(e){
            if(!e.isDefaultPrevented()){
            var id =$('#id1').val();

            $.ajax({
                url : "{{ url('guru/jadwal-mapel').'/'}}" + id,
                type :"POST",
                data : $('#modal-edit form').serialize(),
                success : function(data){
                $('#modal-edit').modal('hide');
                $('#table-jadwal-mapel').DataTable().ajax.reload()
                swal({
                    title: 'Berhasil!',
                    text : 'Jadwal berhasil diperbarui' ,
                    type: 'success',
                    timer: '1500'
                })
                },
                error :function (){
                swal({
                    title : 'Oopss',
                    text : 'Ada Yang salah !',
                    type : 'error',
                    timer : '1500'
                })
                }
            });
            return false;
            }
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
            url : "{{url ('guru/jadwal-mapel')}}"+'/'+id,
            type : "POST",
            data : {'_method':'delete','_token':csrf_token},
            success : function(data){
                $('#table-jadwal-mapel').DataTable().ajax.reload()
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
