<?php

namespace App\Http\Livewire\Personal\Coordinator;

use App\Actions\Subscribes\GetSubscribesAction;
use App\Constants\SubscribesTypes;
use App\Models\User;
use Livewire\Component;

class AboutGroup extends Component
{
    public $group;

    public $users;
    public $selectedYear;
    public $selectedMonth;
    public function mount()
    {
        $this->users = User::where('group_id', $this->group->id)->get();
        /**
         *  Получаем данные по Ежемесячным взносам
         */
        $this->selectedYear = date('Y');
        $this->selectedMonth = date('n');

        $this->updateMonthlySubscribe();
    }

    public function increaseMonth()
    {
        if ($this->selectedMonth === 12) {
            $this->selectedMonth = 1;
        } else {
            $this->selectedMonth++;
        }
        $this->updateMonthlySubscribe();
    }

    public function decreaseMonth()
    {
        if ($this->selectedMonth === 1) {
            $this->selectedMonth = 12;
        } else {
            $this->selectedMonth--;
        }
        $this->updateMonthlySubscribe();
    }

    /**
     * Получение оплаченных взносов
     */
    public function updateMonthlySubscribe()
    {
        $this->users->each(function ($user) {
            /**
             *   Получаем подписку для выбранного периода
             */
            $getSubscribe = new getSubscribesAction();
            $selectSubscribe = $getSubscribe
                ->handle($user, [
                        SubscribesTypes::MONTHLY,
                    ],
                    [
                        'year' => $this->selectedYear,
                        'month' => $this->selectedMonth,
                    ]);

            if ($selectSubscribe) {
                $user->is_subscribe = 1;
            } else {
                $user->is_subscribe = 0;
            }
        });
    }

//    /**
//     * Деактивация пользователя
//     */
//    public function toggleUserStatus($userId)
//    {
//        $user = User::find($userId);
//        if ($user) {
//            $user->update([
//                'is_active' => ! $user->is_active,
//            ]);
//        }
//    }

    public function render()
    {
        return view('livewire.personal.coordinator.about-group', [
            'users' => $this->users,
        ]);
    }
}
