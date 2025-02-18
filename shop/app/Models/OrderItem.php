<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        // Agrega más campos si los necesitas.
    ];

    /**
     * Relación con Order (un Item pertenece a un Pedido)
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relación con Product (un Item pertenece a un Producto)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
