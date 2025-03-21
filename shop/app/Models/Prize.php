<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'prize'];

    // Relación con usuarios (si tienes autenticación)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
