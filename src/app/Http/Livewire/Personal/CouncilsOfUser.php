<?php

namespace App\Http\Livewire\Personal;


use App\Actions\Page\Personal\GetGroupCouncilAction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CouncilsOfUser extends Component
    {
        public $councilGroups;
        public function mount(GetGroupCouncilAction $getGroupCouncilAction)
        {
            $user = Auth::user();
            
            // Получаем группы региона для Члена Совета
            $this->councilGroups = $getGroupCouncilAction->handle($user->councils);
        }
        public function groupSelected($groupId)
        { 
            // Логика при выборе группы
            $this->emit('groupSelector', $groupId);
        }
        public function render()
        {
            return view('livewire.personal.councils-of-user', [
                'councilGroups' => $this->councilGroups
            ]);
        }
    }
