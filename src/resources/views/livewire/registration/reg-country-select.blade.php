<div>
    <select name="country_id" wire:model="countryId" id="countrySelect" style="display: none;" >
        @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>
    <div class="dropdown">
        <div class="dropdown__selected">Выберите страну</div>
        <div class="dropdown__list">
            @foreach($countries as $country)
                <div class="dropdown__item"
                     data-value="{{ $country->id }}"
                     wire:click="$emit('updateTowns', {{ $country->id }})">
                    {{ $country->name }}
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>

    document.addEventListener('livewire:load', function () {
        const getSelectValue = (idTrueSelect) => {
            try {
                let trueSelect = document.getElementById(idTrueSelect);
                let fakeSelect = trueSelect.nextElementSibling;
                let items = fakeSelect.querySelectorAll('.dropdown__item');

                items.forEach(item => {
                    item.addEventListener('click', () => {
                        trueSelect.value = item.dataset.value;
                    //@this.countryId = trueSelect.value;
                    });
                });
            } catch (error) {
                console.log(error);
            }
        }

        getSelectValue('countrySelect');
    });
</script>
