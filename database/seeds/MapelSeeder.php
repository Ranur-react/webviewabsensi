<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mapels')->insert([
            [
                'nama_mapel' => 'Bahas Indonesia'
            ],
            [
                'nama' => 'Bahasa Inggris'
            ],
            [
                'nama' => 'Matematika'
            ]
        ]);
    }
}
