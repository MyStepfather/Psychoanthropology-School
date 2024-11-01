<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaText extends Model
{
    protected $guarded = [];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
