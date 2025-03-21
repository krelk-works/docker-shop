<?php

// app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items'; // Asegúrate de que la tabla sea correcta

    // Definir la relación con el modelo Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Definir la relación con el modelo Shoe
    public function shoe()
    {
        return $this->belongsTo(Shoe::class, 'product_id');
    }

    public function shoeModel()
    {
        return $this->belongsTo(ShoeModel::class, 'model_id', 'id');
    }




}


