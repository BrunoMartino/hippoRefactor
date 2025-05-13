<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NiveisTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            ModulosTableSeeder::class,
            PlanosTableSeeder::class,
            UsuariosTableSeeder::class,
            ConfSistemasTableSeeder::class
        ]);
    }
}
