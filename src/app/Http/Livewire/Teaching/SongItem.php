<?php
namespace App\Http\Livewire\Teaching;

use Livewire\Component;
use App\Models\Media;
use App\Models\MediaResource;
use App\Models\MediaText;
use App\Models\Exercise;
use App\Models\Artist;
use App\Models\Language;
use App\Models\Content; // Модель для бюллетеней связи

class SongItem extends Component
{
    public $item; // Модель для текущего элемента (песня, станс, упражнение или бюллетень связи)
    public $itemLanguages;
    public $itemArtists;
    public $itemTexts;
    public $itemResources;
    public $visible = false; // Изначально компонент скрыт
    public $mediaType; // Тип медиа (song, stans, task или bulletin)

    protected $listeners = ['mediaSelected' => 'loadMedia', 'taskSelected' => 'loadMedia', 'bulletinSelected' => 'loadMedia']; // Добавлено прослушивание 'bulletinSelected'
    public $activeLanguageId; // Идентификатор активного языка

    public function mount($type)
    {
        $this->mediaType = $type;
    }

    public function loadMedia($id)
    {
        if ($id === null) {
            $this->visible = false;
            return;
        }

        switch ($this->mediaType) {
            case 'song':
            case 'stans':
                $this->item = Media::find($id);
                $this->itemResources = MediaResource::where('media_id', $id)->get();
                $this->itemTexts = MediaText::where('media_id', $id)->get();
                break;
            case 'task':
                $this->item = Exercise::find($id);
                if ($this->item) {
                    $this->itemResources = collect(); // Задаем пустую коллекцию для ресурсов
                    $this->itemTexts = collect([
                        (object)[
                            'title' => $this->item->title,
                            'text' => $this->item->text,
                            'date' => $this->item->date, // Предполагаем, что дата хранится в этой колонке
                        ]
                    ]);
                }
                break;
            case 'bulletin':
                $this->item = Content::find($id);
                if ($this->item) {
                    $this->itemTexts = collect([
                        (object)[
                            'title' => 'Бюллетень связи №' . $this->item->number,
                            'text' => $this->item->text,
                            'date' => $this->item->date,
                            'url' => $this->item->url, // URL для скачивания
                        ]
                    ]);
                }
                break;
            default:
                $this->item = null;
        }

        if (!$this->item) {
            $this->visible = true; // Показываем компонент, чтобы отобразить сообщение
            $this->itemLanguages = collect(); // Пустая коллекция
            $this->itemArtists = collect(); // Пустая коллекция
            $this->itemTexts = collect(); // Пустая коллекция
            $this->itemResources = collect(); // Пустая коллекция
            return;
        }

        if ($this->mediaType !== 'task' && $this->mediaType !== 'bulletin') {
            $artistsId = $this->itemResources->pluck('artist_id')->unique();
            $this->itemArtists = Artist::whereIn('id', $artistsId)->get();

            $languagesId = collect([$this->itemResources, $this->itemTexts])
                ->flatten()->pluck('language_id')->unique()->sort()->values()->all();
            $this->itemLanguages = Language::whereIn('id', $languagesId)->orderBy('id', 'asc')->get();

            $this->activeLanguageId = $this->itemLanguages->first()->id ?? null;
        } else {
            $this->itemLanguages = collect();
            $this->itemArtists = collect();
        }

        $this->visible = true;
    }

    public function setActiveLanguage($languageId)
    {
        $this->activeLanguageId = $languageId;
    }

    public function hide()
    {
        $this->visible = false;
        $this->emitUp('mediaSelected', null); // Эмитируем событие, чтобы сбросить состояние в вызывающем компоненте
    }

    public function render()
    {
        return view('livewire.teaching.song-item', [
            'item' => $this->item,
            'itemLanguages' => $this->itemLanguages,
            'itemArtists' => $this->itemArtists,
            'itemTexts' => $this->itemTexts,
            'itemResources' => $this->itemResources,
        ]);
    }
}

