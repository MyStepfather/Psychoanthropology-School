<?php

namespace App\Http\Livewire\Teaching;

use App\Models\Exercise;
use Livewire\Component;

class TaskModal extends Component
{
    public $task;

    protected $listeners = [
      'taskSelected'
    ];
    public function taskSelected($id)
    {
        $this->task = Exercise::query()->where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.teaching.task-modal');
    }
}
