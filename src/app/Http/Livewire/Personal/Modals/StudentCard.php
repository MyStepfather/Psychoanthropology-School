<?php

namespace App\Http\Livewire\Personal\Modals;

use App\Models\User;
use Livewire\Component;

class StudentCard extends Component
{
    public $user = null;
    public $visible = false; // Изначально компонент скрыт
    public $loading = false; // Логика загрузки данных
    protected $listeners = ['userSelected'];

    /**
     * Обработчик события выбора пользователя
     * @param int|null $id
     */
    public function userSelected($id)
    {
        if ($id === null) {
            $this->resetUserData();
            return;
        }

        // Загружаем данные о пользователе по ID
        $this->user = User::with([
            'group.town.country',
            'group.coordinator',
            'group.country',
            'councils',
            'coordinators',
            'helpers',
        ])->find($id);

        // Проверка: если пользователь найден, показываем карточку
        if ($this->user) {
            $this->visible = true;
        } else {
            // Если пользователь не найден, скрываем карточку и сбрасываем данные
            $this->resetUserData();
        }
    }
    public function hide()
    {
        $this->visible = false;
        $this->emitUp('userSelected', null); // Эмитируем событие, чтобы сбросить состояние в вызывающем компоненте
    }

    /**
     * Сброс состояния данных пользователя
     */
    public function resetUserData()
    {
        $this->user = null;
        $this->visible = false;
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.personal.modals.student-card', [
            'user' => $this->user,
            'visible' => $this->visible,
            'loading' => $this->loading,
        ]);
    }
}
