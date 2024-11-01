<?php
namespace App\Http\Livewire\Teaching;

use App\Models\Stans;
use Livewire\Component;
use App\Models\Media;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class StansComponent extends Component
{
    use WithPagination;

    public $currentStansId = null;

    public function getStans(): LengthAwarePaginator
    {
        $stansId = Stans::pluck('media_id')->unique();
        return Media::whereIn('id', $stansId)
            ->orderBy('id', 'asc')
            ->paginate(10);
    }

    public function showStansDetails($id)
    {
        if ($this->currentStansId === $id) {
            $this->currentStansId = null;
            $this->emit('mediaSelected', null);
        } else {
            $this->currentStansId = $id;
            $this->emit('mediaSelected', $id);
        }
    }

    protected $listeners = ['mediaSelected' => 'resetCurrentStans'];

    public function resetCurrentStans($id)
    {
        if ($id === null) {
            $this->currentStansId = null;
        }
    }

    public function render()
    {
        return view('livewire.teaching.stans-component', [
            'stans' => $this->getStans()
        ]);
    }
}
