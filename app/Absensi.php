<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = "absensis";
    protected $fillable = [
        'kelas_id','mapel_id','guru_id','jadwal_mapel_id','pertemuan','tanggal'
    ];

    public function absensi_detail() 
    {
        return $this->hasMany('App\Absensi_detail','absensi_id', 'id');
    }

    public function guru()
	{
        return $this->belongsTo('App\Guru','guru_id', 'id');
    }
    public function kelas()
	{
        return $this->belongsTo('App\Kelas','kelas_id', 'id');
    }
    public function mapel()
	{
        return $this->belongsTo('App\Mapel','mapel_id', 'id');
    }
    public function jadwal()
	{
        return $this->belongsTo('App\Jadwal_mapel','jadwal_mapel_id', 'id');
    }
}
