<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuSpeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'kaiju_id',
        'walking_min',   'walking_max',
        'sprinting_min', 'sprinting_max',
        'swimming_min',  'swimming_max',
        'flying_min',    'flying_max',
    ];

    protected $casts = [
        'walking_min'   => 'float',
        'walking_max'   => 'float',
        'sprinting_min' => 'float',
        'sprinting_max' => 'float',
        'swimming_min'  => 'float',
        'swimming_max'  => 'float',
        'flying_min'    => 'float',
        'flying_max'    => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
