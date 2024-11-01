<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Town extends Model
{
    protected $guarded = [];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
