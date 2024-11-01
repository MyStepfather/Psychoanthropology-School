<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Exercise;
use App\Models\News;
use App\Models\Stans;

class MainPageController extends Controller
{
    public function showPage()
    {
        $news = News::where('is_show', true)
            ->orderBy('published_at', 'desc')
            ->get();
        $exercise = Exercise::where('type', 0)
            ->latest('created_at')
            ->first();
        $event = Event::orderBy('date_start', 'asc')
            ->where('date_start', '>=', now())
            ->with('eventType')
            ->first();
        $stans = Stans::query()->where('is_active', true)
            ->with(['media' => function ($query) {
                $query->with(['mediaTexts' => function ($query) {
                    $query->where('language_id', 1);
                }])
                ->with(['mediaResources']);
            }])
            ->first();
        return view('main', compact('news', 'exercise', 'event', 'stans'));
    }

    public function teaching()
    {
        return view('teaching');
    }
}
