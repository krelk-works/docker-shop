<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'category_id', 'description'];

    protected $table = "shoes";

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function colors(): BelongsToMany {
        return $this->belongsToMany(Color::class)->withTimestamps();
    }

    public function sizes(): BelongsToMany {
        return $this->belongsToMany(Size::class)->withPivot('stock')->withTimestamps();
    }
    
}
