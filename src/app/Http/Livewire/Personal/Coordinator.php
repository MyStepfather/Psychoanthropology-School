<?php

namespace App\Http\Livewire\Personal;

use App\Models\GroupVideo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class
Coordinator extends Component
{
    public $user;

    public $groups;

    public $video;

    //    public $selectedYear;
    //    public $selectedMonth;
    public function groupSelected($groupId)
    {
        // Можно передать идентификатор группы, чтобы отобразить настройки группы
        $this->emit('groupSelected', $groupId);
    }
    public function mount()
    {
        $this->user = Auth::user();

        /**
         * Получаем группы координатора, с учениками
         */
        $this->groups = $this->user->coordinators()
            ->with('users')
            ->get();
        /**
         * Получаем видео для Групп 5 Пути
         */
        $this->updateVideoCurrent();
    }

    /**
     * Получение текущего видео для группы
     *
     * @return void
     */
    public function updateVideoCurrent()
    {
        $currentWeekStart = Carbon::now()->startOfWeek(); // Начало текущей недели

        $this->video = GroupVideo::whereDate('date_start', '<=', $currentWeekStart)
            ->whereDate('date_end', '>=', $currentWeekStart)
            ->first();
    }

    public function updateVideoNext()
    {
        $nextWeekStart = Carbon::now()->startOfWeek()->addWeek(); // Начало следующей недели

        $this->video = GroupVideo::whereDate('date_start', '>=', $nextWeekStart)
            ->whereDate('date_start', '<=', $nextWeekStart->copy()->endOfWeek())
            ->first();
    }

    protected $listeners = ['userSelected'];

    public function userSelected($userId)
    {
        // Передаем событие на компонент карточки студента
        $this->emitTo('personal.modals.student-card', 'userSelected', $userId);
    }

    public function render()
    {
        return view('livewire.personal.coordinator', ['groups' => $this->groups]);
    }
}
