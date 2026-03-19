<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_type', 'post_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForPost(Builder $query, string $postType, int $postId): Builder
    {
        return $query->where('post_type', $postType)->where('post_id', $postId);
    }
}
