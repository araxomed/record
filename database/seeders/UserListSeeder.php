<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = \Carbon\Carbon::now();
        DB::table('users')->insert(['name' => 'Jonni Julian Camargo Cruz', 'email' => 'jonni', 'password' => Hash::make('jonni2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Camilo Hernan Cardozo Peña', 'email' => 'camilo', 'password' => Hash::make('camilo2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Edgar Leon Arboleda Lopez', 'email' => 'edgar', 'password' => Hash::make('edgar2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Berthy Silvana Petro Haddad', 'email' => 'berthy', 'password' => Hash::make('berthy2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Yady Luz Garcia Sierra', 'email' => 'yady', 'password' => Hash::make('yady2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Amaury Jose Oviedo Lemus', 'email' => 'amaury', 'password' => Hash::make('amaury2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Martha Stella Florez Vargas', 'email' => 'martha', 'password' => Hash::make('martha2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Dina Luz Alarcon Martinez', 'email' => 'dinaluz', 'password' => Hash::make('dinaluz2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Silvia Elena Burgos Urango', 'email' => 'silvia', 'password' => Hash::make('silvia2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Kelly Johana Paez Zuñiga', 'email' => 'kelly', 'password' => Hash::make('kelly2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Rocio Milena Ghisays Cogollo', 'email' => 'rocio', 'password' => Hash::make('rocio2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Miguel Segundo Pinedo Polo', 'email' => 'miguel', 'password' => Hash::make('miguel2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Leonardo Tulio Diaz Hernandez', 'email' => 'leonardo', 'password' => Hash::make('leonardo2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Ana Mercedes Pinilla Zabala', 'email' => 'ana', 'password' => Hash::make('ana2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Jorge Bismarck Hueck Salleg', 'email' => 'jorge', 'password' => Hash::make('jorge2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Ruben Dario Peña De Hoyos', 'email' => 'ruben', 'password' => Hash::make('ruben2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Carlos Emilio Rangel Regino', 'email' => 'carlos', 'password' => Hash::make('carlos2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Willian Alfredo Guzman Naranjo', 'email' => 'willian', 'password' => Hash::make('willian2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Ferry Alejandro Salgado Vargas', 'email' => 'ferry', 'password' => Hash::make('ferry2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Osnaider Ochoa Misal', 'email' => 'osnaider', 'password' => Hash::make('osnaider2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Paula Posada Montes', 'email' => 'paula', 'password' => Hash::make('paula2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Lina Maria Vargas Arrieta', 'email' => 'lina', 'password' => Hash::make('lina2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Juan David Muñoz Ocampo', 'email' => 'juan', 'password' => Hash::make('juan2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Diana Patricia Alvarez Calvo', 'email' => 'diana', 'password' => Hash::make('diana2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Dina Luz Padilla Hernandez', 'email' => 'dina', 'password' => Hash::make('dina2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
        DB::table('users')->insert(['name' => 'Cristian Andres Yanez Figueroa', 'email' => 'cristian', 'password' => Hash::make('cristian2022'), 'rol' => 'admin', 'created_at' => $time, 'updated_at' => $time]);
    }
}
