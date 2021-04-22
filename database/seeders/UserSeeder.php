<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'institution_id' => '1',
            'name' => 'ADMINISTRADOR',
            'email' => 'admin@planificacion.gob.bo',
            'password' => bcrypt('AdminMpd123'),
            'state' => 'ACTIVO'
        ]);

        User::create([
            'institution_id' => '1',
            'name' => 'MINISTRO',
            'email' => 'min@planificacion.gob.bo',
            'password' => bcrypt('MinMpd123'),
            'state' => 'ACTIVO'
        ]);
    }
}
