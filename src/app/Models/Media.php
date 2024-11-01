<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Media extends Model
{
    protected $guarded = [];

    public function mediaResources(): HasMany
    {
        return $this->hasMany(MediaResource::class);
    }

    public function mediaTexts(): HasMany
    {
        return $this->hasMany(MediaText::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function stans(): HasOne
    {
        return $this->HasOne(Stans::class);
    }

    public function stanses(): HasMany
    {
        return $this->hasMany(Stans::class);
    }
}
