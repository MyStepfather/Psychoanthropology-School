<?php

namespace App\Http\Livewire\Personal\Coordinator;

use App\Models\User;
use Livewire\Component;

class UserStatusToggler extends Component
{
    public $userId;

    public $isActive;

    public function mount() {
        $this->isActive = User::find($this->userId)->is_active;
    }

    public function toggleUserStatus()
    {
        $user = User::find($this->userId);
        if ($user) {
            $user->update([
                'is_active' => ! $user->is_active,
            ]);
            $this->isActive = ! $this->isActive;
        }
    }

    public function render()
    {
        $this->isActive = User::find($this->userId)->is_active;
        return view('livewire.personal.coordinator.user-status-toggler');
    }
}
