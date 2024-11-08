<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuracion::updateOrCreate(['clave' => 'salud'], ['valor' => 4.00]);
        Configuracion::updateOrCreate(['clave' => 'pencion'], ['valor' => 4.00]);
    }
}
