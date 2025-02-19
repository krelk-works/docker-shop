<?php

namespace Database\Factories;

use App\Models\Shoe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShoeFactory extends Factory
{
    /**
     * El nombre del modelo correspondiente a esta fábrica.
     *
     * @var string
     */
    protected $model = Shoe::class;

    /**
     * Define el estado por defecto de los atributos.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->words(2, true),       // 'Super Runner'
            // 'brand' => $this->faker->company(),           // 'Nike'
            // 'model' => $this->faker->word(),              // 'AirMax'
            'price' => $this->faker->randomFloat(2, 20, 200), // 35.99
            'description' => $this->faker->sentence(),     // 'The best shoes for running'
            'category_id' => $this->faker->numberBetween(1, 2),
            // 'size'  => $this->faker->numberBetween(35, 45),
            // Otros campos si tu migración los define
        ];
    }
}
