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

    public function baseStat()
    {
        return $this->hasOne(KaijuBaseStat::class);
    }

    public function attacks()
    {
        return $this->hasMany(KaijuAttack::class)->orderBy('order');
    }

    public function speeds()
    {
        return $this->hasMany(KaijuSpeed::class);
    }

    public function titles()
    {
        return $this->hasMany(KaijuTitle::class)->orderBy('order');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')
                    ->where('post_type', 'kaiju');
    }
}