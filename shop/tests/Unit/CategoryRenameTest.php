<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;

class CategoryRenameTest extends TestCase
{
    public function test_renombrar_categoria()
    {
        // Obtenemos la categoría que se llama Deportivas
        $categoria = Category::where('name', 'Deportivas')->first();

        // Renombramos la categoría
        $categoria->name = 'Ejemplo';
        $categoria->save();

        // Comprobamos que se haya renombrado
        $this->assertEquals('Ejemplo', $categoria->name);

        // Volvemos a dejar el nombre original
        $categoria->name = 'Deportivas';
        $categoria->save();
    }
}
