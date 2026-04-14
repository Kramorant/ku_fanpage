<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeveloperMedia extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'media_type', 'published_date', 'active', 'order'];

    protected $casts = [
        'active'         => 'boolean',
        'order'          => 'integer',
        'published_date' => 'date',
    ];
}
