<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    protected $guarded = [];

    public function mediaResources(): HasMany
    {
        return $this->hasMany(MediaResource::class);
    }
}
