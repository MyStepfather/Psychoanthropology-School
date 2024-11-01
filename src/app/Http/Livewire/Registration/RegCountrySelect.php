<?php

namespace App\Http\Livewire\Registration;

use App\Models\Country;
use Livewire\Component;

class RegCountrySelect extends Component
{
    public $countryId;

    public $countries;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updatedCountryId()
    {
        $this->skipRender();
        $this->emit('updateTowns', $this->countryId);

    }

    public function render()
    {
        $countries = $this->countries;

        return view('livewire.registration.reg-country-select', $countries);
    }
}
