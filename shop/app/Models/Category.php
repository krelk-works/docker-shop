<?php

namespace App\Models;
use App\Models\Shoe;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $table = "categories";

    public function products()
    {
        return $this->hasMany(Shoe::class, 'category_id'); // Asegúrate de que 'category_id' es la clave foránea correcta
    }
}
