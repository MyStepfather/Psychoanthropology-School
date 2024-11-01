<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    protected $fillable = [
        'author_id',
        'editor_id',
        'title',
        'description',
        'text',
        'image_url',
        'video_url',
        'published_at',
        'is_show',
        'is_video_show',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
