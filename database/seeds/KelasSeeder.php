<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'kelas' => 'VII'
            ],
            [
                'kelas' => 'VIII'
            ],
            [
                'kelas' => 'IX'
            ]
        ]);
    }
}
