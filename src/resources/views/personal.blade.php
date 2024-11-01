@section('title', 'Личная')
@extends('layout.main')

@section('content')
@php extract($data); @endphp

    <section class="lk content-section">
        <div class="categories">
            @if ($coordinator)
                <a href="#coordinator">
                    <div class="font-w">Координатору</div>
                </a>
            @endif
            @if ($councilsOfUser)
                <a href="#member">
                    <div class="font-w">Члену совета</div>
                </a>
            @endif
        </div>
        @if ($courses)
            <div class="lk__courses week-course">
                <div class="lk__heading padding-wrapper">
                    <h1 class="title_fz23_mob">Курс недели</h1>
{{--                        <p class="title_fz12_mob">Все курсы</p>--}}
                </div>
                <div class="week-course__inner">
                    @if ($courses['currentCourse'])
                        <div class="week-course__item week-course__item_active box_content">
                            <h2 class="week-course__heading title_fz23_mob">Эта неделя</h2>
                            <p class="week-course__date title_fz12_mob">
                                {{ \Carbon\Carbon::parse($courses['currentCourse']->date_start)->locale('ru')->isoFormat('D ') }}-
                                {{ \Carbon\Carbon::parse($courses['currentCourse']->date_end)->locale('ru')->isoFormat('D MMMM') }}
                            </p>
                            <div class="week-course__wrapper">
                                <p class="week-course__number">{{ $courses['currentCourse']->number }}</p>
                                <button class="lk-buttons lk-buttons_border font-w" type="button" data-bs-toggle="modal" data-bs-target="#courseCurrentModal">Читать</button>
                            </div>
                        </div>
                    @endif
                    @if ($courses['nextCourse'])
                        <div class="week-course__item box_content">
                            <h2 class="week-course__heading title_fz23_mob">Сл. неделя </h2>
                            <p class="week-course__date title_fz12_mob">
                                {{ \Carbon\Carbon::parse($courses['nextCourse']->date_start)->locale('ru')->isoFormat('D ') }}-
                                {{ \Carbon\Carbon::parse($courses['nextCourse']->date_end)->locale('ru')->isoFormat('D MMMM') }}
                            </p>
                            <div class="week-course__wrapper">
                                <p class="week-course__number">{{ $courses['nextCourse']->number }}</p>
                                <button class="lk-buttons lk-buttons_border font-w" type="button" data-bs-toggle="modal" data-bs-target="#courseNextModal">Читать</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="lk__videos daily-video box_content lk-boxes-groups">
            <div class="daily-video__inner">
                <h2 class="daily-video__title title_fz23_mob">Ежедневные видео</h2>


                @if ($dailyVideos)
                    @livewire('personal.daily-video-slider')
                @else
                    <div class="daily-video__limiter mt-3">
                        <div class="title_fz15_mob">
                            Сожалеем, но у вас нет подписки.
                        </div>
                        <div class="text_fz12_mob">
                            Месячная подписка от 700 ₽
                        </div>
                        <div class="btn_white title_fz12_mob">
                            Подписаться
                        </div>
                    </div>
                @endif

                <span class="white-hr"></span>
                <a href="{{ route('personal.my-video.show') }}" role='button' style="margin-top: 20px !important;"
                    class="d-block mt-5 cursor-pointer daily-video__my-videos title_fz23_mob">
                    Мои видео
                </a>
            </div>
        </div>

        <div class="lk-wrapper">
            <div class="lk-content-wrapper">

                @if ($coordinator)
                    @livewire('personal.coordinator')
                @endif

                @if ($groupsToday)
                    <div class="groups-today">
                        <div class="accordion custom_plus groups-today__inner_red box_content mt--15"
                            id="accordionGroups">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="title_fz23_mob accordion-button collapsed p-0" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseGroups">
                                        Группы сегодня
                                    </button>
                                </h2>
                                <div id="collapseGroups" class="accordion-collapse collapse custom_show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionGroup">
                                    <div class="accordion-body p-0">
                                        <div class="stans_content">
                                            <p class="group__date-interval">{{ $groupsToday->isNotEmpty() ? 'Время начала групп местное' : 'Сегодня нет групп'}}</p>
                                            <ul class="groups-list">

                                                @foreach ($groupsToday as $groupToday)
                                                    <li class="">
                                                        <p class="title_fz15_mob">
                                                            {{ \App\Constants\GroupTypes::ALL_NAMES[$groupToday->type] }} - {{$groupToday->coordinator->name_last}} {{ $groupToday->coordinator->name_first }}
                                                        </p>
                                                        <p class="text_fz15_mob">
                                                            {{ $groupToday->town->name }}
                                                            ({{ $groupToday->country->name }})
                                                            {{ date('H:i', strtotime($groupToday->time)) }}
                                                        </p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($councilGroups)
                    @livewire('personal.councils-of-user')
                    <livewire:personal.modals.coordinator-card/>

                @endif

            </div>
            <div class="lk-modals-card">
                 <div class="lk-mod lk-mod-hide" id="form_to_group_change">
                    @livewire('personal.modals.group-change')
                </div>
                {{-- <div class="lk-mod lk-mod-hide mod-container-settings" id="form_to_group_settings">
                    @livewire('personal.modals.group-settings')
                </div> --}}
{{--                <div class="lk-mod lk-mod-hide" id="form_to_group_payment">--}}
{{--                    @include('partials.modals.payment');--}}
{{--                </div>--}}
                 <div class="lk-mod lk-mod-hide mod-container-reading" id="modal-reading">
                    @include('partials.modals.reading');
                </div> 
            <livewire:personal.modals.student-card/>
            <livewire:personal.modals.group-settings/>

        </div>
        </div>
    </section>

        <div id="overlay"></div>

    @include('partials.modals.courseCurrentModal')
    @include('partials.modals.courseNextModal')

    <style>
        .carousel-control-prev-icon {
            background-image: url("{{ asset("img/icons/Arrow-left-bold.svg") }}") !important;
        }
        .carousel-control-next-icon {
            background-image: url("{{ asset("img/icons/Arrow-right-bold.svg") }}") !important;
        }
    </style>

@endsection
