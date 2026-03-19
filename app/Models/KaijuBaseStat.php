<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuBaseStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kaiju_id',
        'health_min', 'health_max',
        'regen_min',  'regen_max',
    ];

    protected $casts = [
        'health_min' => 'float',
        'health_max' => 'float',
        'regen_min'  => 'float',
        'regen_max'  => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
