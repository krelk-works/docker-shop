<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    // Indica el modelo asociado
    protected $model = Order::class;

    public function definition()
    {
        return [
            // Si tu Order tiene una relación con User
            'user_id' => User::factory(),
            // Campos de ejemplo
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }
}
