<?php

namespace App\Http\Livewire\Teaching;

use Livewire\Component;
use App\Models\Exercise;
use Carbon\Carbon;


class Task extends Component
{
    public $currentTaskId = null;
    public $actualTasks;
    // public $dailyTasks;

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        // Загрузка актуальных задач и ежедневных задач
        $this->actualTasks = Exercise::where('type', 0)->get();
        // $this->dailyTasks = Exercise::where('type', 1)->get();
    }

    public function showTaskDetails($id)
    {
        if ($this->currentTaskId === $id) {
            $this->currentTaskId = null;
            $this->emit('taskSelected', null); // Эмитируем событие для сброса выбранного задания
        } else {
            $this->currentTaskId = $id;
            $this->emit('taskSelected', $id); // Эмитируем событие для выбора задания
        }
    }

    protected $listeners = ['taskSelected' => 'resetCurrentTask'];

    public function resetCurrentTask($id)
    {
        if ($id === null) {
            $this->currentTaskId = null;
        }
    }

    public function render()
    {
        return view('livewire.teaching.task', [
            'actualTasks' => $this->actualTasks,
            // 'dailyTasks' => $this->dailyTasks,
        ]);
    }
}


