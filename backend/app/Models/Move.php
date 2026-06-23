<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        'kaiju_id',
        'name',
        'description',
        'cooldown',
        'stamina_cost',
    ];

    public function kaiju(): BelongsTo
    {
        return $this->belongsTo(Kaiju::class);
    }

    public function moveDamageSteps(): HasMany
    {
        return $this->hasMany(MoveDamageStep::class);
    }
}
