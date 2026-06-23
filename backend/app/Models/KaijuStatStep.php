<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KaijuStatStep extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kaiju_id',
        'stat',
        'sp_level',
        'value_min',
        'value_max',
    ];

    protected function casts(): array
    {
        return [
            'stat' => 'string',
        ];
    }

    public function kaiju(): BelongsTo
    {
        return $this->belongsTo(Kaiju::class);
    }
}
