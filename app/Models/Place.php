<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'region',
        'description',
        'entry_fee',
        'image',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'entry_fee' => 'decimal:2',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
