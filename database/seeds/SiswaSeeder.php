<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswas')->insert([
            'nama' => 'Afdiko Mayte',
            'nisn' => '151100128',
            'email' => 'info.mayteproject@gmail.com',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bengkulu',
            'tgl_lahir' => '13-10-2005',
            'kelas_id'  => 1,
            'nama_ibu_kandung' => 'May',
            'password' => Hash::make('password')
        ]);
    }
}
