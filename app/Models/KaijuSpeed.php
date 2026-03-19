<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuSpeed extends Model
{
    use HasFactory;

    protected $fillable = ['kaiju_id', 'walking_speed', 'sprinting_speed', 'swimming_speed'];

    protected $casts = [
        'walking_speed'   => 'float',
        'sprinting_speed' => 'float',
        'swimming_speed'  => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
