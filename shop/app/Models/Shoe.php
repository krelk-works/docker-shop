<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'model_id', 'price', 'category_id', 'color_id', 'size_id', 
        'image', 'featured', 'discount', 'active', 'main', 'stock'
    ];

   

    // Relación con la Marca
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relación con el Modelo de zapato
    public function model()
    {
        return $this->belongsTo(ShoeModel::class, 'model_id');  // Asegúrate de que este es el nombre correcto de la relación
    }

    // Relación con la Categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con el Color
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    // Relación con la Talla
    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_shoe', 'shoe_id', 'cart_id');
    }
    

}
