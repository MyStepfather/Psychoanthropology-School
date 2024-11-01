<?php
namespace App\Http\Livewire\Teaching;

use App\Constants\MediaTypes;
use App\Models\Stans;
use Livewire\Component;
use App\Models\Media;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class SongsComponent extends Component
{
    use WithPagination;
    public $currentSongId = null;

    public function getSongs(): LengthAwarePaginator
    {
        $stansId = Stans::pluck('media_id')->unique();
        return Media::where('type', MediaTypes::AUDIO)
            ->where('is_free', true)
            ->whereNotIn('id', $stansId)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function showSongDetails($id)
    {
        if ($this->currentSongId === $id) {
            $this->currentSongId = null;
            $this->emit('mediaSelected', null);
        } else {
            $this->currentSongId = $id;
            $this->emit('mediaSelected', $id);
        }
    }

    protected $listeners = ['mediaSelected' => 'resetCurrentSong'];

    public function resetCurrentSong($id)
    {
        if ($id === null) {
            $this->currentSongId = null;
        }
    }

    public function render()
    {
        return view('livewire.teaching.songs-component', [
            'songs' => $this->getSongs()
        ]);
    }
}
