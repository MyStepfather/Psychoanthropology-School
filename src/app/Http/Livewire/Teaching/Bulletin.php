<?php

namespace App\Http\Livewire\Teaching;

use Livewire\Component;
use App\Models\Content; // Модель для бюллетеней

class Bulletin extends Component
{
    public $bulletins; // Список бюллетеней
    public $currentBulletinId = null; // Идентификатор выбранного бюллетеня
    public $selectedYear = null; // Выбранный год для фильтрации
    public $years; // Список лет для фильтрации

    public function mount()
    {
        $this->loadYears(); // Загрузка доступных годов
        $this->loadBulletins(); // Загрузка бюллетеней
    }

    // Загрузка всех доступных лет для фильтрации
    public function loadYears()
    {
        // Получение всех доступных лет на основе даты бюллетеней
        $this->years = Content::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    }

    // Загрузка бюллетеней с фильтрацией по выбранному году
    public function loadBulletins()
    {
        $query = Content::orderBy('date', 'desc');

        if ($this->selectedYear) {
            $query->whereYear('date', $this->selectedYear); // Фильтрация по году
        }

        $this->bulletins = $query->get();
    }

    // Обработка выбора года
    public function updatedSelectedYear($value)
    {
        $this->selectedYear = $value;
        $this->loadBulletins(); // Перезагрузка бюллетеней при изменении года
    }

    // Показ деталей выбранного бюллетеня
    public function showBulletinDetails($id)
    {
        if ($this->currentBulletinId === $id) {
            $this->currentBulletinId = null;
            $this->emit('bulletinSelected', null); // Сброс выбранного бюллетеня
        } else {
            $this->currentBulletinId = $id;
            $this->emit('bulletinSelected', $id); // Выбор бюллетеня
        }
    }

    protected $listeners = ['bulletinSelected' => 'resetCurrentBulletin'];

    public function resetCurrentBulletin($id)
    {
        if ($id === null) {
            $this->currentBulletinId = null;
        }
    }

    public function render()
    {
        return view('livewire.teaching.bulletin', [
            'bulletins' => $this->bulletins,
            'years' => $this->years,
        ]);
    }
}
