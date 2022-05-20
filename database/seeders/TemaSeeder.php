<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        DB::table('temas')->insert(['id' => 1, 'tema' => 'Recurso Humano', 'orden' => 1, 'created_at' => $time, 'updated_at' => $time]);
    }
}
