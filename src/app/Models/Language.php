<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $fillable = [
        'name',
    ];

    public function stansTexts(): HasMany
    {
        return $this->hasMany(MediaText::class);
    }

    public function stansMedias(): HasMany
    {
        return $this->hasMany(MediaResource::class);
    }
}
