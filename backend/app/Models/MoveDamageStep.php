<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MoveDamageStep extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'move_id',
        'damage_sp_level',
        'damage_min',
        'damage_max',
    ];

    public function move(): BelongsTo
    {
        return $this->belongsTo(Move::class);
    }
}
