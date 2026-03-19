<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kaiju_id',
        'stat_type',
        'current_level',
        'val_1', 'val_2', 'val_3', 'val_4', 'val_5',
        'val_6', 'val_7', 'val_8', 'val_9', 'val_10',
    ];

    protected $casts = [
        'val_1'  => 'float', 'val_2'  => 'float', 'val_3'  => 'float',
        'val_4'  => 'float', 'val_5'  => 'float', 'val_6'  => 'float',
        'val_7'  => 'float', 'val_8'  => 'float', 'val_9'  => 'float',
        'val_10' => 'float',
    ];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }

    /**
     * Get the stat value for the given level (1-10).
     */
    public function getValueForLevel(int $level): ?float
    {
        $level = max(1, min(10, $level));
        return $this->{"val_{$level}"};
    }
}
