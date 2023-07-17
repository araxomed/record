<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class User2023_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        $data = [
            ['name' => 'Mercedes Sujey Perez Hoyos', 'email' => 'mercedes', 'password' => Hash::make('mercedes2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Miriam Pérez', 'email' => 'miriam', 'password' => Hash::make('miriam2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Carlos Andres Perez Ochoa', 'email' => 'andres', 'password' => Hash::make('andres2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Luis Guillermo Petro Vidal', 'email' => 'luis', 'password' => Hash::make('luis2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Alberto Junior Salas Cortezano', 'email' => 'alberto', 'password' => Hash::make('alberto2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Guillermo Enrique Vergara Gomez', 'email' => 'guillermo', 'password' => Hash::make('guillermo2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Victor Dario Escudero Castilla', 'email' => 'victor', 'password' => Hash::make('victor2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Yenni Cecilia Fadul Payares', 'email' => 'yenni', 'password' => Hash::make('yenni2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Yuri Neis Genes Castillo', 'email' => 'yuri', 'password' => Hash::make('yuri2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Miladys Genes Padilla', 'email' => 'miladys', 'password' => Hash::make('miladys2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Maydett Rocio Henao Trujillo', 'email' => 'maydett', 'password' => Hash::make('maydett2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Vilma Ruth Macias Acosta', 'email' => 'vilma', 'password' => Hash::make('vilma2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
            ['name' => 'Dania Lucia Martinez Valdivieso', 'email' => 'dania', 'password' => Hash::make('dania2023'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time],
        ];
        User::insert($data);
        User::where('email', 'ana')->update(['password' => Hash::make('ana2023')]);
        User::where('email', 'berthy')->update(['password' => Hash::make('berthy2023')]);
        User::where('email', 'cristian')->update(['password' => Hash::make('cristian2023')]);
        User::where('email', 'diana')->update(['password' => Hash::make('diana2023')]);
        User::where('email', 'dinaluz')->update(['password' => Hash::make('dinaluz2023')]);
        User::where('email', 'jonni')->update(['password' => Hash::make('jonni2023')]);
        User::where('email', 'jorge')->update(['password' => Hash::make('jorge2023')]);
        User::where('email', 'juan')->update(['password' => Hash::make('juan2023')]);
        User::where('email', 'kelly')->update(['password' => Hash::make('kelly2023')]);
        User::where('email', 'leonardo')->update(['password' => Hash::make('leonardo2023')]);
        User::where('email', 'lina')->update(['password' => Hash::make('lina2023')]);
        User::where('email', 'martha')->update(['password' => Hash::make('martha2023')]);
        User::where('email', 'miguel')->update(['password' => Hash::make('miguel2023')]);
        User::where('email', 'osnaider')->update(['password' => Hash::make('osnaider2023')]);
        User::where('email', 'ruben')->update(['password' => Hash::make('ruben2023')]);
        User::where('email', 'willian')->update(['password' => Hash::make('willian2023')]);
        User::where('email', 'yady')->update(['password' => Hash::make('yady2023')]);
    }
}
