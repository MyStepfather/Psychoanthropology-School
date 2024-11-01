<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Stans extends Model
{
    protected $guarded = [];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return HasManyThrough
     */
//    public function mediaTexts(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            MediaText::class,
//            Media::class,
//            'id', // Ссылка на станс из медиа
//            'media_id', // Ссылка на медиа из медиатекст
//            'media_id', // Ссылка на медиа из станс
//            'id' // Ключ в медиа
//        );
//    }

//    public function mediaTexts(): BelongsToMany
//    {
//        return $this->belongsToMany(
//            MediaText::class,
//            'media',
//            'id',
//            'id',
//        );
//    }
}
