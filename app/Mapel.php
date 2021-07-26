<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "mapels";

    protected $fillable = [
        'nama_mapel'
    ];

    public function jadwal() 
    {
        return $this->hasMany('App\Jadwal_mapel','mapel_id', 'id');
    } 

    public function absensi() 
    {
        return $this->hasMany('App\Absensi','mapel_id', 'id');
    } 
}
