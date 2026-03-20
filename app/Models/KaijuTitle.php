<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KaijuTitle extends Model
{
    use HasFactory;

    protected $fillable = ['kaiju_id', 'name', 'requirement', 'order'];

    protected $casts = ['order' => 'integer'];

    public function kaiju()
    {
        return $this->belongsTo(Kaiju::class);
    }
}
