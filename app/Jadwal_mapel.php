<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_mapel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "jadwal_mapels";

    protected $fillable = [
        'kelas_id', 'mapel_id', 'guru_id', 'hari', 'jam', 'tahun_ajar'
    ];

    /**
     * many to many jadwal_mapel->absensi
     */
    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'jadwal_mapel_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Guru', 'guru_id', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }
    public function mapel()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'id');
    }
}
