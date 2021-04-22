<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permisos usuario Administrador
        // Pagina web
        Permission::create([
            'user_id' => '1',
            'system_id' => '1',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '1',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '1',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '1',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // Pagina web MPD
        Permission::create([
            'user_id' => '1',
            'system_id' => '2',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '2',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '2',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '2',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // Reportes
        Permission::create([
            'user_id' => '1',
            'system_id' => '3',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '3',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '3',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '3',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // SISFIN
        Permission::create([
            'user_id' => '1',
            'system_id' => '4',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '4',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '4',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '4',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // SISIN
        Permission::create([
            'user_id' => '1',
            'system_id' => '5',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '5',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '5',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '5',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // SISPLAN
        Permission::create([
            'user_id' => '1',
            'system_id' => '6',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '6',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '6',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '6',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);

        // SISPRO
        Permission::create([
            'user_id' => '1',
            'system_id' => '7',
            'profile_id' => '1',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '7',
            'profile_id' => '2',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '7',
            'profile_id' => '3',
            'state' => 'ACTIVO'
        ]);

        Permission::create([
            'user_id' => '1',
            'system_id' => '7',
            'profile_id' => '4',
            'state' => 'ACTIVO'
        ]);
    }
}
