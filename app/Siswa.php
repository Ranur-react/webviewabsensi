<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\App;


class Siswa extends Authenticatable
{
    use Notifiable;

    protected $guard = 'siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'nisn', 'foto', 'jenis_kelamin', 'tempat_lahir',
        'tgl_lahir', 'kelas_id', 'nama_ibu_kandung', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function absensi_detail()
    {
        return $this->hasMany('App\Absensi_detail', 'siswa_id', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
