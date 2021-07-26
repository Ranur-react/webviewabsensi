<div class="modal fade" id="modal-addEdit">
    <div class="modal-dialog" >
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-judul"></h4>
            </div>
            <div class="modal-body" id="modal-body" style="padding-left: 5%; padding-right: 5%" >
                <form method="POST" action="{{url('admin/data-kelas')}}" class="form-horizontal" data-toggle="validator">
                    {{csrf_field()}} {{method_field('POST')}}
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="Text" class="form-control" id="kelas" name="kelas" placeholder="Masukan Nama">
                    </div>
                </form>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="simpan" class="btn btn-primary">Simpan</button>
        </div>
        
    </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->