<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
            'name' => 'GET',
            'state' => 'ACTIVO'
        ]);

        Profile::create([
            'name' => 'POST',
            'state' => 'ACTIVO'
        ]);

        Profile::create([
            'name' => 'UPDATE',
            'state' => 'ACTIVO'
        ]);

        Profile::create([
            'name' => 'DELETE',
            'state' => 'ACTIVO'
        ]);

        Profile::create([
            'name' => 'ADMIN',
            'state' => 'ACTIVO'
        ]);
    }
}
