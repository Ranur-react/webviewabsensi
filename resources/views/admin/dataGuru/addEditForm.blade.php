<div class="modal fade" id="modal-addEdit">
    <div class="modal-dialog" >
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-judul"></h4>
            </div>
            <div class="modal-body" id="modal-body" style="padding-left: 5%; padding-right: 5%" >
                <form method="POST" action="{{url('admin/data-guru')}}" class="form-horizontal" data-toggle="validator">
                    {{csrf_field()}} {{method_field('POST')}}
                    <div class="form-group">
                        <label for="nama">Guru</label>
                        <input type="Text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="nip">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan E-mail" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" >
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