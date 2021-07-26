<div class="modal fade" id="modal-edit">
    <div class="modal-dialog" >
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-judul"></h4>
            </div>
            <div class="modal-body" id="modal-body" style="padding-left: 5%; padding-right: 5%" >
                <form method="POST" action="{{url('siswa/edit-profil-post')}}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                    {{csrf_field()}} {{method_field('POST')}}
                    <div class="form-group">
                        <label class="control-label">Foto</label>
                        <input class="form-control" type="file" name="foto" id="foto" value="{{$siswa->foto}}" >
                    </div>
                    <div class="form-group">
                        <label for="kelas">Nama</label>
                        <input type="Text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">NISN</label>
                        <input type="Text" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}" placeholder="Masukan NISN" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id" required>
                            @if ($siswa->kelas_id == null)
                                <option></option>
                            @else
                            <option value="{{$siswa->kelas_id}}">{{$siswa->kelas->kelas}}</option>
                            @endif
                            @foreach ($kelas as $kls)
                            <option value="{{$kls->id}}">{{$kls->kls}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required   >
                            <option value="{{$siswa->jenis_kelamin}}">{{$siswa->jenis_kelamin}}</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tempat Lahir</label>
                        <input type="Text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{$siswa->tempat_lahir}}" placeholder="Masukan Tempat Lahir" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl_lahir" id="datepicker" value="{{$siswa->tgl_lahir}}"  required>
                        </div>
                    <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label for="kelas">Nama Ibu kandung</label>
                        <input type="Text" class="form-control" id="nama_ibu_kandung" name="nama_ibu_kandung" value="{{$siswa->nama_ibu_kandung}}" placeholder="Masukan Ibu Kandung" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                </form>
        </div>
        
    </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->