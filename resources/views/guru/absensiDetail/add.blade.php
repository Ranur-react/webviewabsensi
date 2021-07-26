<div class="modal fade" id="modal-add">
    <div class="modal-dialog" >
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-judul"></h4>
            </div>
            <div class="modal-body" id="modal-body" style="padding-left: 5%; padding-right: 5%" >
                <form method="POST" action="{{url('guru/absensi-detail')}}" class="form-horizontal" data-toggle="validator">
                    {{csrf_field()}} {{method_field('POST')}}
                    
                    <input type="hidden" name="jadwal_mapel_id" value="{{$jadwal_mapels->id}}" >
                    <input type="hidden" name="kelas_id" value="{{$jadwal_mapels->kelas->id}}" >
                    <input type="hidden" name="guru_id" value="{{$jadwal_mapels->guru->id}}" >
                    <input type="hidden" name="mapel_id" value="{{$jadwal_mapels->mapel->id}}" >
                    <div class="form-group">
                        <label for="jam">Pertemuan Ke</label>
                        <input type="Text" class="form-control" id="pertemuan" name="pertemuan" placeholder="cotoh: 1">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tanggal" id="datepicker" required>
                        </div>
                    <!-- /.input group -->
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