<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Opcional, si el nombre de la tabla no es "stocks", especificarlo:
    protected $table = 'stocks';

    /**
     * Campos que se pueden asignar en masa (mass assignable).
     */
    protected $fillable = [
        'shoe_id',
        'color_id',
        'size_id',
        'quantity',
    ];

    /**
     * Relación: un Stock pertenece a un Shoe.
     */
    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    /**
     * Relación: un Stock pertenece a un Color (ColorShoe).
     * Ajusta la clase si tu modelo se llama distinto (p. ej. ColorShoe::class).
     */
    public function colorShoe()
    {
        return $this->belongsTo(ColorShoe::class, 'color_id');
    }

    /**
     * Relación: un Stock pertenece a un Size (ShoeSize).
     * Ajusta la clase si tu modelo se llama distinto (p. ej. ShoeSize::class).
     */
    public function shoeSize()
    {
        return $this->belongsTo(ShoeSize::class, 'size_id');
    }
}
