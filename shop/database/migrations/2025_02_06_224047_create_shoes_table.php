<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shoes', function (Blueprint $table) {
            $table->id();

            // Asociamos la marca y el modelo del zapato
            $table->foreignId('brand_id')->constrained()->onDelete('cascade'); // Si se borra la marca, se borran los zapatos de esa marca
            $table->foreignId('model_id')->constrained()->onDelete('cascade'); // Si se borra el modelo, se borran los zapatos de ese modelo
            // -----------------------------------------------------------------------------------------------------------------------------
            
            $table->decimal('price', 8, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // No borra la categoria, si se borra la categoría entonces los zapatos de esa categoría se borran
        
            // Color y talla no se eliminan si se borra el zapato ni viceversa
            $table->foreignId('color_id')->constrained()->onDelete('restrict'); // Evita borrar colores si hay zapatos con ese color
            $table->foreignId('size_id')->constrained()->onDelete('restrict');  // Evita borrar tallas si hay zapatos con esa talla
            // --------------------------------------------------------------------------------------------------------------------
            
            $table->string('image')->nullable();

            $table->boolean('featured')->default(false);
            $table->unsignedTinyInteger('discount')->default(0);

            // Calzado activo o inactivo
            $table->boolean('active')->default(true);

            // Se usará como imagen principal del calzado
            $table->boolean('main')->default(false);

            // Columna de stock disponible
            $table->unsignedSmallInteger('stock')->default(0);
            // -----------------------------------------------
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoes');
    }
};
