<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $guarded = [];

    public function groups(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                Group::class,
                'group_course',
                //                'group_id',
                //                'course_id'
            )
            ->withPivot('date_start', 'date_end')
            ->withTimestamps();
    }

    /**
     * редактор курса
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class)
            ->withPivot('date_start', 'date_end')
            ->withTimestamps();
    }
}
