<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),   // Genera un Order automático
            'product_id' => Product::factory(), // Genera un Product automático
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
