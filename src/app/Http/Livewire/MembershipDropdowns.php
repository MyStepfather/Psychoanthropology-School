<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Group;
use Livewire\Component;

class MembershipDropdowns extends Component
{
    public $groups = [];
    public $countries = [];
    public $towns = [];
    public $coordinators = [];
    public $selectedCountry = null;
    public $selectedTown = null;
    public $selectedCoordinator = null;

    public function mount()
    {
        $user = auth()->user();
        $this->groups = Group::query()
            ->get()
            ->unique('country_id');
        $this->selectedCountry = $user->group->country->name;
        $this->selectedTown = $user->group->town->name;
        $this->selectedCoordinator = $user->group->place;
        $this->countries = $this->groups->pluck('country');
    }

    // public function updateSelectedCountry($value) // Исправленное название метода
    // {
    //     $this->countries = $this->groups->pluck('country');
    //     // $this->towns = $this->groups->pluck('town');
    //     // dd($this->towns);
    //     $this->selectedCountry = Country::select('name')->where('id', $value)->get();
    //     $this->towns = Group::where('country_id', $value)->get();
    //     $this->coordinators = []; // Сбросить список координаторов при изменении страны
    // }

    public function updatedSelectedCity($value)
    {
        $this->coordinators = Group::where('country_id', $this->selectedCountry)
            ->where('town_id', $value)
            ->pluck('coordinator_user_id', 'id');
    }
}
