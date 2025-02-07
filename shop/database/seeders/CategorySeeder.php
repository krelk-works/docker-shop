<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Deportivas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Casuales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Formales',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
