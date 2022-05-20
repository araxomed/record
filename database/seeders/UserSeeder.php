<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        DB::table('users')->insert([
            'name' => 'Daniel José Franco Hoyos',
            'email' => 'admin',
            'password' => Hash::make('admin1235'),
            'rol' => 'super',
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
