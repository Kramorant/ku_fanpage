<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kaiju extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function stats()
    {
        return $this->hasMany(KaijuStat::class);
    }

    public function attacks()
    {
        return $this->hasMany(KaijuAttack::class)->orderBy('order');
    }

    public function speeds()
    {
        return $this->hasMany(KaijuSpeed::class);
    }

    public function regen()
    {
        return $this->hasMany(KaijuRegen::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('post_type', 'kaiju');
    }
}
