<?php

namespace App\Http\Livewire\Registration;

use App\Models\Group;
use Livewire\Component;

class RegGroupSelect extends Component
{
    public $countryId;

    public $townId;

    public $groups;

    protected $listeners = ['updateGroupsByTown', 'updateGroupsByCountry'];

    public function mount()
    {
        $this->groups = Group::all();
    }

    public function updateGroupsByCountry($countryId)
    {
        $this->groups = Group::where('country_id', $countryId)->get();
    }

    public function updateGroupsByTown($townId)
    {
        $this->groups = Group::where('town_id', $townId)->get();
    }

    public function render()
    {
        return view('livewire.registration.reg-group-select', $this->groups);
    }
}
