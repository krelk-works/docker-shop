<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $table = "carts";

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Define una relación de muchos a muchos entre Carrito (Cart) y Zapatos (Shoe).
     * 
     * Un carrito puede contener múltiples zapatos y un zapato puede estar en varios carritos.
     * Además, en la tabla intermedia (cart_shoe), se almacenan datos adicionales:
     * - quantity (cantidad de zapatos en el carrito)
     * - size_id (talla del zapato seleccionado)
     * - color_id (color del zapato seleccionado)
     */
    public function shoes(): BelongsToMany {
        return $this->belongsToMany(Shoe::class) // Define la relación muchos a muchos con la tabla 'shoes'
                    ->withPivot('quantity', 'size_id', 'color_id') // Incluye columnas adicionales de la tabla intermedia 'cart_shoe'
                    ->withTimestamps(); // Guarda automáticamente las fechas de creación y actualización en la tabla intermedia
    }
}
