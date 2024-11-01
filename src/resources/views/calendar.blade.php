@extends('layout.main')

@section('title', 'Календарь')

@section('content')

    <section class="calendar my-container content-section">

        <div class="my-container-border">
            <div class="calendar__title title_fz23_mob">Календарь</div>
            <div class="events-box">
                <div class="calendar__close box_content groups-today groups-today__inner_blue">
                    <h2 class="calendar__heading title_fz18_mob">Ближайшие события</h2>
                    <p class="calendar__date title_fz15_mob">
                        {{ \Carbon\Carbon::parse($closestEvent->date_start)->locale('ru')->isoFormat('D ') }}-
                        {{ \Carbon\Carbon::parse($closestEvent->date_end)->locale('ru')->isoFormat('D MMMM') }}.
                        {{ $closestEvent->eventType->name }}
{{--                        {{ \Carbon\Carbon::parse($closestEvent->date_start)->translatedFormat('d') }}--}}
{{--                        - {{ \Carbon\Carbon::parse($closestEvent->date_end)->translatedFormat('d MMMM') }}.--}}
{{--                        {{ $closestEvent->eventType->name }}--}}
                    </p>
                    <p class="calendar__info text_fz15_mob">Информация о записи и стоимости</p>
                    <button class="btn_dark calendar__btn">Оплатить участие</button>
                </div>
            </div>

            @php
                $uniqueYears = $events->pluck('date_start')->map(function ($date) {
                    return \Carbon\Carbon::parse($date)->format('Y');
                })->unique();
            @endphp

            @foreach ($uniqueYears as $year)
                <div class="groups-today">
                    <div class="accordion custom_plus groups-today__inner_blue box_content" id="accordionGroups_{{ $year }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button--justify-position title_fz18 accordion-button collapsed p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGroups_{{ $year }}">
                                    {{ $year }}
                                </button>
                            </h2>
                            <div id="collapseGroups_{{ $year }}" class="accordion-collapse collapse custom_show" aria-labelledby="headingOne" data-bs-parent="#accordionGroup_{{ $year }}">
                                <div class="accordion-body p-0">
                                    <div class="events">
                                        <p class="events__title title_fz18">Стажи</p>
                                        <ul class="events__list">
                                            @foreach ($stages as $stage)
                                                @if (\Carbon\Carbon::parse($stage->date_start)->format('Y') === $year)
                                                    <li class="">
                                                        <p class="events__item text_fz15_mob">{{ \Carbon\Carbon::parse($stage->date_start)->locale('ru')->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($stage->date_end)->locale('ru')->translatedFormat('d M') }}</p>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <p class="events__title title_fz18">Обучения</p>
                                        <ul class="events__list">
                                            @foreach ($studies as $studie)
                                                @if (\Carbon\Carbon::parse($studie->date_start)->format('Y') === $year)
                                                    <li class="">
                                                        <p class="events__item text_fz15_mob">{{ \Carbon\Carbon::parse($studie->date_start)->locale('ru')->translatedFormat('d M') }} - {{ \Carbon\Carbon::parse($studie->date_end)->locale('ru')->translatedFormat('d M') }}</p>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="padding-wrapper">
                <div class="calendar-reg">
                    <h2 class="calendar-reg__steps title_fz18">Порядок регистрации на обучения и стажи</h2>
                    <div class="calendar-reg__main-container">
                        <div class="calendar-reg__container">
                            <h3 class="calendar-reg__title title_fz15_mob">Ученику</h3>
                            <p class="calendar-reg__text text_fz15_mob">Сообщить о намерении участвовать координатору или ответственному за запись в своей группе и оплатить участие (лично или в группе)</p>
                        </div>
                        <div class="calendar-reg__container">
                            <h3 class="calendar-reg__title title_fz15_mob">Координатору</h3>
                            <ol type="1" class="calendar-reg__list">
                                <li class="calendar-reg__item text_fz15_mob">Скачать таблицу и заполнить её</li>
                                <li class="calendar-reg__item text_fz15_mob">Оплатить участие по реквизитам ООО «ИМАЖЕССАНС» (лично или в группе)</li>
                                <li class="calendar-reg__item text_fz15_mob">Отправить чек и заполненную Exel-таблицу на почту reg@shkolapa.org</li>
                            </ol>
                        </div>
                        <div class="calendar-reg__container">
                            <h3 class="calendar-reg__title title_fz15_mob">После регистрации</h3>
                            <p class="calendar-reg__text text_fz15_mob">После обработки заявки, вы получите ответ от команды регистрации.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script src="{{ asset('js/modules/header.js') }}" defer></script>

@endsection
