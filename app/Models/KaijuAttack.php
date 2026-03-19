<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuAttack extends Model
{
    use HasFactory;

    protected $fillable = ['kaiju_id', 'name', 'damage', 'description', 'order'];

    protected $casts = [
        'damage' => 'float',
        'order'  => 'integer',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
