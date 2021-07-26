@extends('layouts.appAdmin')
@section('content')
<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">data-guru</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-lg-10">
        <h1 class="page-header">Data Guru</h1>
    </div>
    
</div>
<!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Kelola Data Guru
                <div class="pull-right">
                    <a onClick="addForm()" type="button" class="btn btn-primary btn-sm">Tambah Data</a>           
                </div>
            </div>
            
            <div class="panel-body">
                <div class="col-md-12">
                    <table id="table-data-guru" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info" style="width: 100%">
                        <thead style="background-color: #30A5FF">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </div>
        </div><!-- /.panel-->
    @include('admin.dataGuru.addEditForm')
    </div><!-- /.col-->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#table-data-guru').dataTable({
        processing: false,
        serverSide: false,
        scrollY: false,
        scrollX: true,
        scrollapse : true,
        bDestroy: true,
        touppercase:true,
        ajax:"{{route('api.data.guru')}}",
            columns:[
            {data: 'DT_RowIndex', name : 'DT_RowIndex'},
            {data: 'nama', name : 'nama'},
            {data: 'email', name : 'email'},
            {data: 'action', name : 'action', orderable : false, searchable : false, render : false}
            ]
        });
    });

    function addForm(){
        save_method = "add";
        $('input[name =_method]').val('POST');
        $('#modal-addEdit').modal('show');  
        $('.modal-judul').text('Tambah Guru'); 
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
                $('#table-data-guru').DataTable().ajax.reload();

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
            url : "{{url ('admin/data-guru')}}"+'/'+id,
            type : "POST",
            data : {'_method':'delete','_token':csrf_token},
            success : function(data){
                $('#table-data-guru').DataTable().ajax.reload()
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