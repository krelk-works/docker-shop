<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    public function test_crear_categoria()
    {
        // Creamos la categoria
        $categoria = Category::create([
            'name' => 'Sabatilla',
        ]);

        // Verificar que la categoria fue creada
        $this->assertDatabaseHas('categories', [
            'name' => 'Sabatilla',
        ]);

        // Eliminar la categoria
        $categoria->delete();
    }
}
