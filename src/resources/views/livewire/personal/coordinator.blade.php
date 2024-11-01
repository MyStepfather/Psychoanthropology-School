<div id="coordinator" class="lk__group group lk-boxes">
    @php
        setlocale(LC_TIME, 'ru_RU.UTF-8');
    @endphp
    <h2 class="group__heading mt-25 padding-wrapper font-w">Координатору</h2>

    @if($groups->isEmpty())
        <p>Материалы еще не добавлены</p>
    @else
        @foreach ($groups as $key => $group)
            <div class="modal-inner mt-3">
                <div class="group__inner box_content lk-boxes-groups w-100-per for-group-changes-modal">
                    <div class="group__settings">
                        <h2 class="group__title title_fz23_mob">
                            {{ \App\Constants\GroupTypes::ALL_NAMES[$group->type] ?? 'Неизвестная группа' }}
                        </h2>
                        <button class="group__settings-btn title_fz12_mob" wire:click="groupSelected({{ $group->id }})"
                            data-id-group="{{ $group->id }}">
                            <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.00001 13.5257C11.1656 13.5257 12.9212 11.6825 12.9212 9.40868C12.9212 7.13489 11.1656 5.29163 9.00001 5.29163C6.83442 5.29163 5.07886 7.13489 5.07886 9.40868C5.07886 11.6825 6.83442 13.5257 9.00001 13.5257Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M14.6693 5.35168C14.866 5.64731 15.0382 5.96009 15.184 6.28659L17.2998 7.52171C17.564 8.76409 17.5667 10.052 17.3079 11.2957L15.184 12.5308C15.0382 12.8573 14.866 13.1701 14.6693 13.4657L14.7102 16.0131C13.8135 16.8711 12.7522 17.5174 11.5978 17.9087L9.51465 16.5964C9.17199 16.6221 8.82801 16.6221 8.48535 16.5964L6.41041 17.9001C5.25228 17.5159 4.18752 16.8721 3.28982 16.0131L3.33067 13.4743C3.13565 13.1746 2.96356 12.8591 2.81602 12.5308L0.70023 11.2957C0.436041 10.0533 0.433253 8.76534 0.692061 7.52171L2.81602 6.28659C2.96182 5.96009 3.134 5.64731 3.33067 5.35168L3.28982 2.80425C4.1865 1.94633 5.24777 1.29998 6.40224 0.908691L8.48535 2.221C8.82801 2.19527 9.17199 2.19527 9.51465 2.221L11.5896 0.917269C12.7477 1.30144 13.8125 1.94529 14.7102 2.80425L14.6693 5.35168Z"
                                    stroke="#102F39" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Настройки
                        </button>
                    </div>

                    {{-- Проверка на наличие данных о видео --}}
                    @if ($group->type === \App\Constants\GroupTypes::WORK)
                        <p class="group__date-interval">Видео недели:
                            <span class="group__date-interval-value">
                                @if($video !== null)
                                    {{ \Carbon\Carbon::parse($video->date_start)->locale('ru')->isoFormat('D ') }}-
                                    {{ \Carbon\Carbon::parse($video->date_end)->locale('ru')->isoFormat('D MMMM') }}
                                @else
                                    Нет активного станса
                                @endif
                            </span>
                        </p>

                        {{-- Проверка на наличие объекта видео перед выводом данных --}}
                        @if($video !== null)
                            <div class="group__info title_fz18">
                                <p class="group__info-number font-w">
                                    {{ $video->code ?? 'Код не указан' }}
                                </p>
                                <p class="group__info-date font-w">
                                    {{ \Carbon\Carbon::parse($video->date)->locale('ru')->isoFormat('D MMMM YYYY') ?? 'Дата не указана' }}
                                </p>
                                <p class="group__info-name font-w">
                                    <span class="font-w">{{ $video->name ?? 'Название не указано' }}</span>
                                    -
                                    <span>{{ $video->duration ?? 'Длительность не указана' }}</span> мин.
                                </p>
                            </div>

                            {{-- Проверка на наличие URL перед выводом кнопки --}}
                            @if($video->url)
                                <div class="group__btn mb-3">
                                    <a href="{{ $video->url }}" target="_blank">
                                        <button class="btn_white title_fz12_mob">Смотреть</button>
                                    </a>
                                </div>
                            @else
                                <p>URL для просмотра видео не указан.</p>
                            @endif

                            {{-- Проверка на наличие пароля перед выводом --}}
                            <div class="mt-4 group__all-video font-w">
                                <div class="font-w">Пароль:
                                    <span class="font-w">{{ $video->password ?? 'Пароль не указан' }}</span>
                                </div>
                            </div>
                        @else
                            <p>Нет активного видео для этой группы.</p>
                        @endif
                    @elseif($group->type === \App\Constants\GroupTypes::READ)
                        <div class="btn_dark title_fz15_mob mt-4 ms-0 mod-btn-reading-trig">
                            Открыть курс для группы
                        </div>
                    @endif

                    <span class="white-hr"></span>

                    {{-- Блок О группе --}}
                    <div class="accordion custom_plus group__accordion" id="accordionGroup{{ $key }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne{{ $key }}">
                                <button class="title_fz23_mob accordion-button collapsed p-0" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseGroup{{ $key }}"
                                    aria-expanded="true" aria-controls="collapseOne"
                                    >
                                    О группе
                                </button>
                            </h2>
                            <div id="collapseGroup{{ $key }}" class="accordion-collapse collapse custom_show"
                                aria-labelledby="headingOne{{ $key }}"
                                data-bs-parent="#accordionGroup{{ $key }}">
                                <div class="accordion-body p-0">
                                    <div class="stans_content group-tools show-composition" id="group-tools"
                                        data-action="group-tools">
                                        <div class="group-tools__btn-container">
                                            <button class="group-tools__btn font-w" id="show-composition"
                                                data-action="show-composition">
                                                <img src="img/icons/UsersThree.svg" alt="">
                                                Cостав
                                            </button>
                                            <button class="group-tools__btn tab__btn tab__btn-active font-w"
                                                id="show-contributions" data-action="show-contributions">
                                                <img src="img/icons/Coins.svg" alt="">
                                                Взносы
                                            </button>
                                        </div>

                                        {{-- Подключение Livewire-компонента для группы --}}
                                        <livewire:personal.coordinator.about-group :wire:key="$group->id"
                                            :group="$group" />

                                        <div id="group-tools_changes" data-id-group="{{ $group->id }}"
                                            class="btn_white title_fz12_mob mt-4">
                                            Сообщить об изменениях в группе
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let showCompositionBtns = document.querySelectorAll('[data-action="show-composition"]');
            let showContributionsBtns = document.querySelectorAll('[data-action="show-contributions"]');
            let groupTools = [];

            if (showCompositionBtns && showContributionsBtns) {
                showContributionsBtns.forEach(item => {
                    item.addEventListener('click', () => {
                        groupTools = item.closest('[data-action="group-tools"]');
                        showCompositionBtn = item.previousElementSibling;

                        showCompositionBtn.classList.remove("tab__btn-active");
                        item.classList.add("tab__btn-active");

                        groupTools.classList.remove("show-contributions");
                        groupTools.classList.add("show-composition");
                    });
                });

                showCompositionBtns.forEach(item => {
                    item.addEventListener('click', () => {
                        groupTools = item.closest('[data-action="group-tools"]');
                        showContributionsBtn = item.nextElementSibling;

                        showContributionsBtn.classList.remove("tab__btn-active");
                        item.classList.add("tab__btn-active");

                        groupTools.classList.remove("show-composition");
                        groupTools.classList.add("show-contributions");
                    });
                });
            }
        });
    </script>
</div>
