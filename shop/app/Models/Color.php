<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;

    protected $table = "colors";

    public function shoes(): BelongsToMany {
        return $this->belongsToMany(Shoe::class)->withTimestamps();
    }
}
