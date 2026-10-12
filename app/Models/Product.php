<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'description', 'price',
        'dp_percent', 'badge', 'image', 'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getDpAmountAttribute()
    {
        return $this->price * $this->dp_percent / 100;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}