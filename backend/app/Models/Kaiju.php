<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Kaiju extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'thumbnail_path',
        'can_fly',
        'can_glide',
    ];

    protected function casts(): array
    {
        return [
            'can_fly' => 'boolean',
            'can_glide' => 'boolean',
        ];
    }

    public function kaijuStatSteps(): HasMany
    {
        return $this->hasMany(KaijuStatStep::class);
    }

    public function moves(): HasMany
    {
        return $this->hasMany(Move::class);
    }

    public function favouritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_fav_kaijus')
            ->withPivot('created_at');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
