<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'type',
        'date',
        'title',
        'text',
        'month',
        'published_at',
    ];
}
