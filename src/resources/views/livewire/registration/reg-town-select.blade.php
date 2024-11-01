<div>
    <select name="town_id" id="citySelect" style="display: none;">
        @foreach($towns as $town)
            <option value="{{ $town->id }}">{{ $town->name }}</option>
        @endforeach
    </select>
    <div class="dropdown">
        <div class="dropdown__selected">Выберите город</div>
        <div class="dropdown__list">
            @foreach($towns as $town)
                <div class="dropdown__item" data-value="{{ $town->id }}" wire:click="$emit('updateGroupsByTown', {{ $town->id  }})">{{ $town->name }}</div>
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
                    // @this.countryId = trueSelect.value;
                        // Livewire.emit('updateTowns', trueSelect.value);
                    });
                });
            } catch (error) {
                console.log(error);
            }
        }

        getSelectValue('citySelect');
    });
</script>
