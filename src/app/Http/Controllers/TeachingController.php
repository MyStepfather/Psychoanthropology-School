<?php

namespace App\Http\Controllers;

use App\Constants\ContentTypes;
use App\Models\Artist;
use App\Models\BookManager;
use App\Models\Content;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Language;
use App\Models\Media;
use App\Models\MediaResource;
use App\Models\MediaText;
use Illuminate\View\View;

class TeachingController extends Controller
{
    public function tasks(): View
    {
//        
        $actualTasks = Exercise::where('type', 0)->get();
        $dailyTasks = Exercise::where('type', 1)->get();
        return view('teaching', compact('actualTasks', 'dailyTasks'));
    }

    public function showTaskItem($id)
    {
        $taskItem = Exercise::find($id);
        if (!$taskItem) {
            abort(404);
        }
        return view('teaching', compact('taskItem'));
    }

    public function books(): View
    {
        $bookManagers = BookManager::with('user')->get();
        return view('teaching', compact('bookManagers'));
    }

    public function songs(): View
    {
        //Это заглушка для работы роута, логика прописана в компоненте livewire
        $stub = "";
        return view('teaching', compact('stub'));
    }

    public function showSongItem($id)
    {
        $item = Media::find($id);
        if (!$item) {
            abort(404);
        }
    
        $itemResources = MediaResource::where('media_id', $id)->get();
        $itemTexts = MediaText::where('media_id', $id)->get();
    
        $artistsId = MediaResource::where('media_id', $id)->pluck('artist_id')->unique();
        $itemArtists = Artist::whereIn('id', $artistsId)->get();
    
        $languagesId = collect([$itemResources, $itemTexts])
            ->flatten()->pluck('language_id')->unique()->sort()->values()->all();
        $itemLanguages = Language::whereIn('id', $languagesId)->orderBy('id', 'asc')->get();
    
        return view('teaching', [
            'item' => $item,
            'itemLanguages' => $itemLanguages,
            'itemArtists' => $itemArtists,
            'itemTexts' => $itemTexts,
            'itemResources' => $itemResources,
            'type' => 'song' // Указываем тип медиа для использования в компоненте
        ]);
    }
    

    public function bulletin(): View
    {
        $bulletins = Content::query()
            ->where('type', ContentTypes::BULLETIN)
            ->select('id', 'number', 'date')
            ->get();
        return view('teaching', compact('bulletins'));
    }

    public function showBulletinItem($id)
    {
        $bulletinItem = Content::find($id);
        if (!$bulletinItem) {
            abort(404);
        }
        return view('teaching', compact('bulletinItem'));
    }

    public function study(): View
    {
        $entry_docs = Content::query()->where('type', ContentTypes::ENTRY_DOCUMENT)->get();
        
        return view('teaching', compact('entry_docs'));
    }

    public function archive(): View
    {
        $courses = Course::query()->select('name')->get();
        return view('teaching', compact('courses'));
    }

    public function others()
    {
        $articles = Content::query()->where('type', ContentTypes::ARTICLE)->get();
        return view('teaching', compact('articles'));
    }

    public function showOthersItem($id)
    {
        $articleItem = Content::find($id);
        if (!$articleItem) {
            abort(404);
        }
        return view('teaching', compact('articleItem'));
    }
}
