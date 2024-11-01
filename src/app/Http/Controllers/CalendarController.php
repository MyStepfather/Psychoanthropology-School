<?php

namespace App\Http\Controllers;

use App\Models\Event;

class CalendarController extends Controller
{
    public function showPage()
    {

        $events = Event::orderBy('date_start', 'asc')
            ->where('date_start', '>=', now())
            ->with('eventType')
            ->get();

        $closestEvent = $events->first();

        $stages = Event::where('event_type_id', 1)
            ->where('date_start', '>=', now())
            ->orderBy('date_start', 'asc')
            ->get();

        $studies = Event::where('event_type_id', 2)
            ->where('date_start', '>=', now())
            ->orderBy('date_start', 'asc')
            ->get();

        return view('calendar', compact('events', 'stages', 'studies', 'closestEvent'));
    }
}
