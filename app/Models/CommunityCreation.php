<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityCreation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'author', 'active', 'order'];

    protected $casts = [
        'active' => 'boolean',
        'order'  => 'integer',
    ];
}
