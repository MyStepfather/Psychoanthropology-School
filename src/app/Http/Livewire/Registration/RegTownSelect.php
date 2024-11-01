<?php

namespace App\Http\Livewire\Registration;

use App\Models\Town;
use Livewire\Component;

class RegTownSelect extends Component
{
    public $countryId;

    public $townId;

    public $countries;

    public $towns;

    protected $listeners = ['updateTowns'];

    public function mount()
    {
        $this->towns = Town::all();
    }

    public function updateTowns($countryId)
    {
        $this->towns = Town::where('country_id', $countryId)->get();
        $this->emit('updateGroupsByCountry', $countryId);
    }

    public function render()
    {
        $towns = $this->towns;

        return view('livewire.registration.reg-town-select', $towns);
    }
}
