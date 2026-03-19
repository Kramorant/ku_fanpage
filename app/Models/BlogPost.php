<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'video_url'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')
                    ->where('post_type', 'blog');
    }

    /**
     * Convert a YouTube watch URL to an embed URL.
     */
    public function getEmbedUrl(): ?string
    {
        if (empty($this->video_url)) {
            return null;
        }

        // Handle youtu.be short links
        if (preg_match('/youtu\.be\/([^?&]+)/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Handle standard watch?v= links
        if (preg_match('/[?&]v=([^&]+)/', $this->video_url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Already an embed URL or other format – return as-is
        return $this->video_url;
    }
}
