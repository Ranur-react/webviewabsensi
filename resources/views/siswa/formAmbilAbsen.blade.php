<div class="modal fade" id="modal-add">
    <div class="modal-dialog" >
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-judul"></h4>
            </div>
            <div class="modal-body" id="modal-body" style="padding-left: 5%; padding-right: 5%" >
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
                <form method="POST" action="{{url('siswa/isi-absen')}}" class="form-horizontal" data-toggle="validator">
                    {{csrf_field()}} {{method_field('POST')}}
                    
                    <input type="hidden" name="absensi_id" id="id" value="" >
                    <input type="hidden" name="siswa_id"  value="{{Auth::guard('siswa')->user()->id}}" >
                    <table class="table"> 
                        <tr>
                            <td style="width: 12rem><div class="radio">
                                <input  type="radio" name="status_kehadiran" value="Hadir"> Hadir
                            </div></td>
                            <td style="width: 12rem>
                                <div class="radio">
                                    <input  type="radio" name="status_kehadiran" value="Izin"> Izin
                                </div>
                            </td>
                            <td style="width: 12rem>
                                <div class="radio">
                                    <input  type="radio" name="status_kehadiran" value="Sakit"> Sakit
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-group col-md-12">
                        
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        
    </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->