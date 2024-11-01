<div>
    <select name="group_id" id="groupSelect" style="display: none;">
        @foreach($groups as $group)
            <option value="{{ $group->id }}">{{ $group->id }}</option>
        @endforeach
    </select>
    <div class="dropdown">
        <div class="dropdown__selected">Выберите группу</div>
        <div class="dropdown__list">
            @foreach($groups as $group)
                <div class="dropdown__item" data-value="{{ $group->id }}">Координатор {{ $group->coordinator->name_first }} {{ $group->coordinator->name_last }}</div>
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
                    });
                });
            } catch (error) {
                console.error(error);
            }
        }

        getSelectValue('groupSelect');
    });
</script>

