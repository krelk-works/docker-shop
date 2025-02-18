<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente (mass assignment).
     * Ajusta según los campos de tu tabla 'orders'.
     */
    protected $fillable = [
        'user_id',
        'status',
        'total',
        // agrega aquí otras columnas que quieras poder rellenar
    ];

    /**
     * Relación con el modelo User (si un pedido pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con OrderItem (un pedido tiene varios items).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
