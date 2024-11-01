<div>
    <div class="modal-header-task">
        <h2 class="title_fz23_mob">
            Настройки группы
        </h2>
        <button type="button" class="close-task-modal">
            <span><img src="./img/icons/cross.svg"></img></span>
        </button>
    </div>
    <div class="modal-body-task">
        <div class="mod-task-body-item">
            <label class="mb-2 title_fz15_mob" for="">Тип</label>
            <div class="dropdown-disable">
                @if($group)
                    <div class="dropdown__selected">{{ \App\Constants\GroupTypes::ALL_NAMES[$group->type] }}</div>
                @endif
            </div>
        </div>
        <div class="mod-task-body-item">
            <label class="mb-2 title_fz15_mob" for="">Страна</label>
            <div class="dropdown-disable">
                @php
                    $country = $group?->town?->country->name ?: $group?->country?->name;
                @endphp
                @if($country)
                    <div class="dropdown__selected">{{ $country }}</div>
                @endif
            </div>
        </div>
        <div class="mod-task-body-item">
            <label class="mb-2 title_fz15_mob" for="">Город</label>
            <div class="dropdown-disable">
                <div class="dropdown__selected">{{ $group?->town?->name }}</div>
            </div>
        </div>
        <div class="mod-task-body-item">
            <label class="mb-2 title_fz15_mob" for="">Регион</label>
            <div class="dropdown-disable">
                @php
                    $council = $group?->town?->council->name ?: $group?->country?->council?->name;
                @endphp
                @if($council)
                    <div class="dropdown__selected">{{ $council }}</div>
                @endif
            </div>
        </div>

        <div class="mod-task-body-item">
            <label class="mb-2 title_fz15_mob" for="">Дата и время
                проведения:</label>
            <div class="users-date__date-lists users-date__date-lists-gap" id="topic_form_main">
                <div class="dropdown-for-livewire" style="width: 50%;">

                    @php
                        $dayName = \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::now()->startOfWeek()->addDays($selectedDay - 1)->locale('ru')->isoFormat('dddd'))
                    @endphp
                    <div class="dropdown__selected">
                        {{ $dayName }}
                    </div>
                    <div class="dropdown__list">
                        <div class="dropdown__item" data-day="1">Понедельник</div>
                        <div class="dropdown__item" data-day="2">Вторник</div>
                        <div class="dropdown__item" data-day="3">Среда</div>
                        <div class="dropdown__item" data-day="4">Четверг</div>
                        <div class="dropdown__item" data-day="5">Пятница</div>
                        <div class="dropdown__item" data-day="6">Суббота</div>
                        <div class="dropdown__item" data-day="7">Воскресенье</div>
                    </div>
                </div>
                <div class="users-date__date-lists">
                    <input wire:model="hour"
                           class="form-select form-select_time display-flex-center"/>
                    <span
                        class="fw-bold users-data__list_no-width pt-2 display-flex-center">:</span>
                    <input wire:model="minutes"
                           class="form-select form-select_time display-flex-center"/>
                </div>
            </div>
        </div>
        <div class="mod-task-body-item">
            <label for="message_form_main" class="mb-2 title_fz15_mob">Место
                проведения</label>
            <textarea
                wire:model="place"
                class="mod-text-area"
                id="exampleFormControlTextarea1"
                rows="2">
            </textarea>
        </div>

        {{--        Первый помощник--}}
        @if($helper1)
            <div class="mod-task-body-item">
                <label class="mb-2 title_fz15_mob" for="">Помощник координатора</label>
                <div class="dropdown-for-livewire">
                    <div class="dropdown__selected">
                        @php
                            $helpername1 = $helper1?->name_last . ' ' . $helper1?->name_first ? : '';
                        @endphp
                        {{ $helpername1 }}
                    </div>
                    <div class="dropdown__list">
                        @if($group?->users)
                            @foreach($group?->users as $user)
                                <div class="dropdown__item"
                                     data-id-helper1="{{$user->id}}">
                                    {{ $user->name }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{--        Второй помощник--}}
        @if($helper2)
            <div class="mod-task-body-item">
                <label class="mb-2 title_fz15_mob" for="">Помощник координатора</label>
                <div class="dropdown">
                    <div class="dropdown__selected">
                        @php
                            $helpername2 = $helper2?->name_last . ' ' . $helper2?->name_first ? : '';
                        @endphp
                        {{ $helpername2 }}
                    </div>
                    <div class="dropdown__list">
                        @if($group?->users)
                            @foreach($group?->users as $user)
                                <div class="dropdown__item"
                                     data-id-helper2="{{$user->id}}">
                                    {{ $user->name }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="">
            <button
                wire:click="updateGroup"
                class="btn_dark btn_dark_modal mt-2" style="max-width: 314px;">
                Сохранить изменения
            </button>
        </div>
    </div>

    <script>
        // Получение элементов выпадающих списков
        const dropdowns = document.querySelectorAll('.dropdown-for-livewire');

        // Добавление обработчиков событий к каждому выпадающему списку
        dropdowns.forEach(function(dropdown) {
            // Получение элементов внутри выпадающего списка
            let selected = dropdown.querySelector('.dropdown__selected');
            let list = dropdown.querySelector('.dropdown__list');

            // Обработка клика по выбранному элементу
            selected.addEventListener('click', function() {
                // Показ/скрытие списка
                list.classList.toggle('visible');
                selected.classList.toggle('dropdown__selected--active');
            });

            // Обработка клика по элементу списка
            list.addEventListener('click', function(event) {
                // Получение текста выбранного элемента
                let text = event.target.textContent;

                //Проверка на селект выбора дня недели и передача в livewire
                if (event.target.hasAttribute('data-day')) {
                    let selectedDay = event.target.getAttribute('data-day');
                    Livewire.emit('daySelected', selectedDay);
                }

                //Проверка на селект выбора 1-го помощника координатора и передача в livewire
                if (event.target.hasAttribute('data-id-helper1')) {
                    let helpersId1 = event.target.getAttribute('data-id-helper1');
                    Livewire.emit('helpers1Selected', helpersId1);
                }

                //Проверка на селект выбора 2-го помощника координатора и передача в livewire
                if (event.target.hasAttribute('data-id-helper2')) {
                    let helpersId2 = event.target.getAttribute('data-id-helper2');
                    Livewire.emit('helpers2Selected', helpersId2);
                }


                // Изменение текста выбранного элемента
                selected.textContent = text;
                // Удаление предыдущего выбранного элемента
                if (dropdown.querySelector('.selected')) {
                    dropdown.querySelector('.selected').classList.remove('selected');
                }

                // Добавление класса выбранному элементу
                event.target.classList.add('selected');

                // Скрытие списка
                list.classList.remove('visible');
                selected.classList.remove('dropdown__selected--active');
            });
        });

    </script>
</div>


