<?php

namespace App\Http\Livewire\Personal\Modals;

use App\Actions\Subscribes\GetSubscribesAction;
use App\Constants\SubscribesTypes;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CoordinatorCard extends Component
    {
        public $group;
        public $members;
        public $selectedYear;
        public $selectedMonth;
        public $visible = false; 

        public $coordinator;

        protected $listeners = ['groupSelector'];
        public function groupSelector($groupId)
        {
            if ($groupId === null) {
                $this->resetGroupData();
                return;
            }
            $this->group = Group::query()
                ->where('id', $groupId)
                ->with('coordinator')
                ->first()
            ;
            $this->coordinator = $this->group->coordinator;
            $this->members = $this->group->users;

            $this->selectedYear = date('Y');
            $this->selectedMonth = date('n');

            $this->updateMonthlySubscribe();

            if ($this->group) {
                $this->visible = true;
            } else {
                // Если пользователь не найден, скрываем карточку и сбрасываем данные
                $this->resetGroupData();
            }
            $this->emit('showCard', ['townId' => $this->group->town_id]);

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
            if ($this->members) {
                $this->members->each(function ($user) {
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
        
        public function hide()
        {
            $this->visible = false;
            $this->emitUp('groupSelector', null); // Эмитируем событие, чтобы сбросить состояние в вызывающем компоненте
        }
        public function resetUserData()
        {
            $this->group = null;
            $this->visible = false;
        }
        public function render()
        {
            return view('livewire.personal.modals.coordinator-card', [
                'members' => $this->members,
                'coordinator' => $this->coordinator
            ]);
        }
    }
