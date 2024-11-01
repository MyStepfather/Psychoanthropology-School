<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AudioPlayer extends Component
{
    public $isOpen;
    public $media;

    public function mount($media)
    {
        $this->isOpen = false;
        $this->media = $media;
    }

    public function openModal(): void
    {
        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}
