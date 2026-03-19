<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'event_date'];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')
                    ->where('post_type', 'event');
    }
}
