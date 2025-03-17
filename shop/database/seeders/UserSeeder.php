<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Leo',
            'email' => 'leo@moonshoes.com',
            'password' => '$2y$10$jG1MQZvR7i/RySAsW3EAMO6ETxwb5SwBM0gQmck3Dwk5wF/4PyKT.', // Contraseña ya hasheada -> 1234
            'role' => 'Admin',
            'email_verified_at' => Carbon::now(), // Fecha actual
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'name' => 'Julia',
            'email' => 'julia@moonshoes.com',
            'password' => '$2y$10$jG1MQZvR7i/RySAsW3EAMO6ETxwb5SwBM0gQmck3Dwk5wF/4PyKT.', // Contraseña ya hasheada -> 1234
            'role' => 'Admin',
            'email_verified_at' => Carbon::now(), // Fecha actual
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
    
    );
    }
}