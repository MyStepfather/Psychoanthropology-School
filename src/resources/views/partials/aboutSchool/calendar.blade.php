<div class="about-the-groups__calendar">
    <h3 class="about-the-groups__title title_fz18_mob">Календарь групп</h3>
    <p class="about-the-groups__text text_fz15_mob">Выберите один или несколько критериев, по которым будет
        выдан список групп.</p>
    <a class="criteria" href="" data-bs-toggle="modal" data-bs-target="#groups-calendar-modal">
        <div class="criteria__wrapper">
            <img class="criteria__ico" src="{{ asset('img/icons/SlidersHorizontal.svg') }}">
            <p class="criteria__txt title_fz12">Критерии</p>
        </div>
    </a>
    <div class="filters">
        @foreach($_GET as $key => $item)
            @if($item)
                <div data-filter="{{ $key }}" class="filters__tab">
                    <p class="filter__txt title_fz12">
                        @if($key === 'country' && $item) {{ $countries->filter(fn($country) => $country['id'] === intval($item))->first()['name'] }} @endif
                        @if($key === 'town' && $item) {{ $towns->filter(fn($city) => $city['id'] === intval($item))->first()['name'] }} @endif
                        @if($key === 'weekday' && $item) {{ \Carbon\Carbon::now()->startOfWeek()->addDays(intval($item) - 1)->locale('ru')->isoFormat('dddd') }} @endif
                        @if($key === 'group' && $item) {{ constant('App\Constants\GroupTypes::ALL_NAMES')[constant('App\Constants\GroupTypes::'.strtoupper($item))] }} @endif
                        @if($key === 'online' && $item === "on") online @endif
                    </p>
                    <button onclick="deleteFilterTab(event);">
                        <img src="{{ asset('img/icons/Annulation.svg') }}" class="filter__ico">
                    </button>
                </div>
            @endif
        @endforeach
    </div>
    <div class="groups-calendar">
        @foreach($arrGroups as $item)
            <div class="groups-calendar__item">
                <h2 class="groups-calendar__name title_fz15_mob">
                    Куратор группы: {{ $item['coordinator']['name_first'] }} {{ $item['coordinator']['name_last'] }}
                </h2>
                <h2 class="groups-calendar__place text_fz15_mob">
                    {{ $item['town']['name'] }} ({{ $item['country']['name'] }}) {{ date('H:i', strtotime($item['time'])) }} @if($item['is_online']) <span class="text-success">(Online)</span> @endif
                </h2>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="groups-calendar-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div style="max-width: 360px" class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between">
                <button
                    onclick="clearAllSelectsForm();"
                    class="text_fz15_mob">
                    Очистить
                </button>
                <h2 class="title_mod title_fz18">Критерии</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="groups-calendar-form">
                <div class="my-3">
                    <div class="title_fz15_mob font-bold">Страна</div>
                    <div>
                        <select id="groups-calendar-form-country" class="form-select" name="country" required>
                            <option value="" selected disabled>Выберите страну</option>
                            @foreach($countries as $item)
                                <option value="{{ $item['id'] }}" @if(isset($_GET['country']) && intval($_GET['country']) === $item['id']) selected @endif>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <div class="title_fz15_mob font-bold">Город</div>
                    <div>
                        <select
                            id="groups-calendar-form-town"
                            class="form-select"
                            name="town"
                            @if(!isset($_GET['town']) || !isset($_GET['country']) || !$_GET['town'] || !$_GET['country']) disabled @endif
                            required
                        >
                            <option value="" selected disabled>Выберите город</option>
                            @if(isset($_GET['country']) && isset($_GET['town']))
                                @foreach($towns as $item)
                                    @if($item['country_id'] === intval($_GET['country']))
                                        <option
                                            value="{{ $item['id'] }}"
                                            @if(intval($_GET['town']) === $item['id']) selected @endif
                                        >
                                            {{ $item['name'] }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <div class="title_fz15_mob font-bold">День проведения</div>
                    <div>
                        <select class="form-select" name="weekday" required>
                            <option value="" selected disabled>Выберите день</option>
                            @php $now = \Carbon\Carbon::now()->startOfWeek()->locale('ru'); @endphp
                            @for ($i = 0; $i < 7; $i++)
                                <option value="{{ $i + 1 }}" @if(isset($_GET['weekday']) && intval($_GET['weekday']) === ($i + 1)) selected @endif>
                                    {{ $now->isoFormat('dddd') }}
                                </option>
                                @php $now->addDay(); @endphp
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <div class="title_fz15_mob font-bold">Группа</div>
                    <div>
                        <select class="form-select" name="group">
                            <option value="" selected>Выберите группу</option>
                            <option
                                value="{{ constant('App\Constants\GroupTypes::WORK') }}"
                                @if(isset($_GET['group']) && $_GET['group'] === constant('App\Constants\GroupTypes::WORK')) selected @endif
                            >
                                {{ constant('App\Constants\GroupTypes::ALL_NAMES')[constant('App\Constants\GroupTypes::WORK')] }}
                            </option>
                            <option
                                value="{{ constant('App\Constants\GroupTypes::READ') }}"
                                @if(isset($_GET['group']) && $_GET['group'] === constant('App\Constants\GroupTypes::READ')) selected @endif
                            >
                                {{ constant('App\Constants\GroupTypes::ALL_NAMES')[constant('App\Constants\GroupTypes::READ')] }}
                            </option>
                            <option
                                value="{{ constant('App\Constants\GroupTypes::NEW') }}"
                                @if(isset($_GET['group']) && $_GET['group'] === constant('App\Constants\GroupTypes::NEW')) selected @endif
                            >
                                {{ constant('App\Constants\GroupTypes::ALL_NAMES')[constant('App\Constants\GroupTypes::NEW')] }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-switch form-check">
                    <label class="form-check-label" for="flexSwitchCheckCalendar">Онлайн</label>
                    <input
                        class="form-check-input"
                        name="online" type="checkbox"
                        role="switch"
                        id="flexSwitchCheckCalendar"
                        @if(isset($_GET['online']) && $_GET['online'] === 'on') checked @endif
                    >
                </div>
                <button type="submit" class="btn_mod btn_dark">Показать результаты</button>
            </form>
        </div>
    </div>
</div>

<script>
    //Получение городов
    const groupsCalendarTownsArray = {{ Js::from($towns) }};

    // Отслеживаем изменение
    document.getElementById('groups-calendar-form-country').addEventListener('change', e => {
        const citySelect = document.getElementById('groups-calendar-form-town');

        //Очистка селекта с городами
        clearSelectTowns();

        const valueSelect = Number(e.target.value);
        if(!valueSelect || !groupsCalendarTownsArray.length) return;

        const filtredTowns = groupsCalendarTownsArray.filter(city => city.country_id === valueSelect);
        if(!filtredTowns.length) return;

        filtredTowns.forEach(city => {
            const option = document.createElement('option');
            option.value = city.id;
            option.textContent = city.name;
            citySelect.appendChild(option);
        })
        citySelect.removeAttribute('disabled');
    })

    //Очистка селекта с городами
    function clearSelectTowns() {
        const citySelect = document.getElementById('groups-calendar-form-town');
        citySelect.innerHTML = '';
        const option = document.createElement('option');
        option.value = "";
        option.textContent = "Выберите город";
        option.setAttribute('selected', true);
        option.setAttribute('disabled', true);
        citySelect.appendChild(option);
        citySelect.setAttribute('disabled', true);
    }

    //Сброс формы
    function clearAllSelectsForm() {
        const url = window.location.href;

        const questionMarkIndex = url.indexOf("?");
        if (questionMarkIndex === -1) return;

        window.location.href = url.substring(0, questionMarkIndex);
    }

    //Удаление хлебных крошек фильтра
    function deleteFilterTab(e) {
        const tab = e.target.closest('.filters__tab');
        const filterValue = tab.getAttribute('data-filter');

        // Удаление ключа из адресной строки
        const url = new URL(window.location.href);
        url.searchParams.delete(filterValue);

        // Перенаправление на обновленный URL
        window.location.href = url.href;
    }
</script>
