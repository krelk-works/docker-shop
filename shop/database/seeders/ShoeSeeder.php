<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShoeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shoes')->insert([
            [
                'name' => 'Nike Air Max',
                'description' => 'Zapatillas deportivas con amortiguación Air Max.',
                'price' => 129.99,
                'category_id' => 1, // Asegúrate de que esta categoría exista
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas Ultraboost',
                'description' => 'Zapatillas de running con tecnología Boost.',
                'price' => 149.99,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Casual',
                'description' => 'Zapatillas cómodas para el día a día.',
                'price' => 89.99,
                'category_id' => 2, // Asegúrate de que esta categoría exista
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
