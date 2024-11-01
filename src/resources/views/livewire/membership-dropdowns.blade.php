<div>
    <div class="users-group">
        <div class="dropdown">
            <div class="dropdown__selected">{{ $selectedCountry }}</div>
            <div class="dropdown__list">
                @foreach ($countries as $country)
                    {{-- @php
                        dd($country);
                    @endphp --}}
                    <div wire:click='updateSelectedCountry({{ $country->id }})' class="dropdown__item">
                        {{ $country->name }}</div>
                @endforeach
            </div>
            <input type="hidden" name="country" id="">
        </div>
        <div class="dropdown">
            <div class="dropdown__selected">{{ $selectedTown }}</div>
            <div class="dropdown__list">
                @foreach ($towns as $town)
                    {{-- @php
                        dd($town);
                    @endphp --}}
                    <div wire:click="$set('selectedCity', '{{ $town->id }}')" class="dropdown__item">
                        {{ $town->name }}</div>
                @endforeach
            </div>
            <input type="hidden" name="city" id="">
        </div>
        <div class="dropdown">
            <div class="dropdown__selected">{{ $selectedCoordinator }}</div>
            <div class="dropdown__list">
                @foreach ($coordinators as $coordinatorId => $coordinatorName)
                    <div wire:click="$set('selectedCoordinator', '{{ $coordinatorId }}')" class="dropdown__item">
                        {{ $coordinatorName }}</div>
                @endforeach
            </div>
            <input type="hidden" name="coordinator" id="">
        </div>
    </div>
</div>
