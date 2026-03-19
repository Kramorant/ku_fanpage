<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class CarouselImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'caption', 'order', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'order'  => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true)->orderBy('order');
    }
}
