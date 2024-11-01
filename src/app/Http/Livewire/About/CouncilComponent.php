<?php

namespace App\Http\Livewire\About;

use Livewire\Component;
use App\Models\Council;

class CouncilComponent extends Component
{
    public $councils;
    public $currentStudentCard = null;

    public function mount()
    {
        // Загружаем советы вместе с пользователями
        $this->councils = Council::with(['users'])->get();
    }

    public function StudentCardDetails($id)
    {
        // Вызываем событие, передавая ID пользователя
        $this->emit('userSelected', $id);
        $this->currentStudentCard = $id;
    }

    public function render()
    {
        return view('livewire.about.council-component', [
            'councils' => $this->councils,
        ]);
    }
}
