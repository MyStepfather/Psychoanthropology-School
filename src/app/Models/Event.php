<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'event_type_id',
        'title',
        'text',
        'date_start',
        'date_end',
        'is_show',
    ];

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }
}
