<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Council
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Council newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Council newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Council query()
 *
 * @mixin \Eloquent
 */
class Council extends Model
{
    protected $guarded = [];

    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    public function towns(): HasMany
    {
        return $this->hasMany(Town::class);
    }

    /**
     * Член совета
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
