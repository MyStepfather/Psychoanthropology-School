<div class="about structure-school tab__about-content animate__animated animate__fadeIn ">
    <div class="about__title title_fz23_mob mt-4">
        О Школе
    </div>
    <h2 id="structure-school_head" class="title_fz23_mob mt-5 mt-lg-4">
        Структура и совет
    </h2>
    <h2 class="title_fz18_mob mt-5">
        Функции и цели Совета
    </h2>
    <ul class="text_fz15_mob structure-school__list mt-2">
        <li>Быть ресурсом для групп, координаторов, ответственных и для каждого ученика</li>
        <li>Следить за передачей Учения</li>
        <li>Быть гарантом духа Учения, уважения правил и структуры</li>
        <li>Быть посредником между Школой и внешним миром</li>
        <li>Представлять ученика на пути, идущего к воплощению качеств Духа через применение поведения Бодхисатв.</li>
    </ul>
    <h2 class="title_fz18_mob mt-5">
        Структура Школы и Совет
    </h2>
    <div class="box_content structure-school_head title_fz18_mob mt-3 mb-10">
        Школа ПА
    </div>

    @foreach ($councils as $council)
        @if ($council->parent_id === null && $council->name !== 'Россия')
            <div class="accordion custom_plus box_content structure-school__region box_content-green about-structure-wrapper mb-10"
                 id="accordion{{ $council->id }}">
                <div class="accordion-item w-100-per_all">
                    <h2 class="accordion-header" id="heading{{ $council->id }}">
                        <button
                            class="title_fz18_mob accordion-button accordion-button--justify-position collapsed p-0 about-structure-btn"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $council->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $council->id }}"
                             >
                            {{ $council->name }}
                        </button>
                    </h2>
                    <div id="collapse{{ $council->id }}"
                         class="accordion-collapse collapse custom_show"
                         aria-labelledby="heading{{ $council->id }}"
                         data-bs-parent="#accordion{{ $council->id }}"
                         wire:ignore.self>
                        @if ($council->towns->count() > 0)
                            <div class="mt-3 title_fz12">
                                @foreach ($council->towns as $key => $town)
                                    {{ $town->name }}{{ $key + 1 < $council->towns->count() ? ',' : '' }}
                                @endforeach
                            </div>
                        @else
                            <div class="mt-3">
                                Нет связанных городов.
                            </div>
                        @endif

                        <div class="accordion-body p-0">
                            {{-- Отображение представителей совета --}}
                            @if ($council->users->count() > 0)
                                @foreach ($council->users as $user)
                                    <div class="structure-school__person mt-3">
                                        <div class="structure-school__icon-person">
                                            <img src="{{ asset('img/icons/profile-circle.svg') }}" alt="">
                                        </div>
                                        <a href="#" class="p-0 text-left"
                                                wire:click.prevent="StudentCardDetails({{ $user->id }})">
                                            {{ $user->full_name ?? $user->first_name . ' ' . $user->last_name }}
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="mt-3">
                                    Нет представителей в этом совете.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<div class="song-details-container">
    <livewire:personal.modals.student-card :id="$currentStudentCard" />
</div>
