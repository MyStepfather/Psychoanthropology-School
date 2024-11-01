<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Country
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 *
 * @mixin \Eloquent
 */
class Country extends Model
{
    protected $guarded = [];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function council(): BelongsTo
    {
        return $this->belongsTo(Council::class);
    }
}
