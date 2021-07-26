<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     *Menambah Admin Kedalam database menggunkan Seeder
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'nama' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
