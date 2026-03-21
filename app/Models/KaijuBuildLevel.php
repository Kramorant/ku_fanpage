<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuBuildLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'kaiju_id', 'level',
        'damage_multiplier',
        'walking', 'sprinting', 'swimming', 'flying',
        'health',
        'health_regen', 'charge_regen',
    ];

    protected $casts = [
        'level'             => 'integer',
        'damage_multiplier' => 'float',
        'walking'           => 'float',
        'sprinting'         => 'float',
        'swimming'          => 'float',
        'flying'            => 'float',
        'health'            => 'float',
        'health_regen'      => 'float',
        'charge_regen'      => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
