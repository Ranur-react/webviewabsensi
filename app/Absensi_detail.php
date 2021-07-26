<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi_detail extends Model
{
    protected $table = "absensi_details";
    protected $fillable = [
        'absebsi_id', 'siswa_id', 'jadwal_mapel_id', 'status_kehadiran', 'ket'
    ];

    public function absensi()
    {
        return $this->belongsTo('App\Absensi', 'absensi_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id', 'id');
    }
}
