<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    use HasFactory;

    /**
     * Campos que se pueden asignar masivamente (mass assignment).
     * Ajusta según los campos de tu tabla 'orders'.
     */
    protected $fillable = [
        'user_id',
        'status',
        // agrega aquí otras columnas que quieras poder rellenar
    ];

      // Definir la relación con el modelo User
      public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shoes(){
        return $this->belongsToMany(Shoe::class, 'cart_shoe', 'order_id', 'shoe_id');
    }

    public function items()
    {
        //sino quitar el 'order_id'
        return $this->hasMany(OrderItem::class, 'order_id');  // Asumiendo que tienes un modelo OrderItem
    }










    /**
     * Relación con el modelo User (si un pedido pertenece a un usuario).
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Relación con OrderItem (un pedido tiene varios items).
     */
    // public function items()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
}
