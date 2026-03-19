<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuAttack extends Model
{
    use HasFactory;

    protected $fillable = ['kaiju_id', 'name', 'damage_min', 'damage_max', 'cooldown', 'charge_cost', 'description', 'order'];

    protected $casts = [
        'damage_min'  => 'float',
        'damage_max'  => 'float',
        'cooldown'    => 'float',
        'charge_cost' => 'float',
        'order'       => 'integer',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
