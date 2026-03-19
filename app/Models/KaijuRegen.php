<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuRegen extends Model
{
    use HasFactory;

    protected $fillable = ['kaiju_id', 'health_regen_pct', 'charge_regen_pct'];

    protected $casts = [
        'health_regen_pct'  => 'float',
        'charge_regen_pct'  => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
