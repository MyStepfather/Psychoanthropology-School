<?php

namespace App\Http\Livewire\Registration;

use Livewire\Component;

class RegFourstep extends Component
{
    public $checkbox1 = false;
    public $checkbox2 = false;
    public $buttonActive = false;

    protected $listeners = ['updateCheckboxState'];

    public function mount()
    {
        $this->buttonActive = $this->checkbox1 && $this->checkbox2;
    }

    public function updateCheckboxState($state)
    {
        $this->checkbox1 = $state['checkbox1'];
        $this->checkbox2 = $state['checkbox2'];
        $this->buttonActive = $this->checkbox1 && $this->checkbox2;
    }

    public function render()
    {
        return view('livewire.registration.reg-fourstep');
    }
}
