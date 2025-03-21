<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class proba1 extends TestCase
{
    public function test_get_discounted_price()
    {
        // Crear un objeto Shoe ficticio
        $shoe = new Shoe(['name' => 'Nike Air', 'price' => 100, 'discount' => 20]);

        // Ejecutar el método y verificar el resultado
        $this->assertEquals(80, $shoe->getDiscountedPrice());
    }


}
