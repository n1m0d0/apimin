<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::create([
            'name' => 'Pagina web',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'Pagina web MPD',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'Reportes',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'SISFIN',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'SISIN',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'SISPLAN',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'SISPRO',
            'state' => 'ACTIVO'
        ]);

        System::create([
            'name' => 'GESTIONDEUSUARIOS',
            'state' => 'ACTIVO'
        ]);
    }
}
