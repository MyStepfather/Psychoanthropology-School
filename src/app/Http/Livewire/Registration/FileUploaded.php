<?php

namespace App\Http\Livewire\Registration;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploaded extends Component
{
    use WithFileUploads;

    public $photo;
    
    public $isUploaded;

    public function updatedPhoto()
    {
        $this->isUploaded = true; // Установим флаг, что фото загружено
    }

    public function render()
    {
        return view('livewire.registration.file-uploaded');
    }
}
