@extends('layout.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="bck-login">
        <article class="reg vh-100">
            <div class="reg__header login__header">
                <img src="/img/navbar/logo.svg" alt="" class="login__logo">
                <h1 class="login__name">Школа Психоантропологии</h1>
                <h2 class="reg__title title_fz23">Создание нового аккаунта</h2>
            </div>
            <div class="reg__wrapper login__wrapper box_content box_content_white">
                <div class="reg__content">
                    <div class="reg__steps">
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h class="step__txt title_fz12">Этап 1</h>
                        </div>
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h class="step__txt title_fz12">Этап 2</h>
                        </div>
                        <div class="reg__step reg__step_active">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h class="step__txt title_fz12">Этап 3</h>
                        </div>
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h class="step__txt title_fz12">Этап 4</h>
                        </div>
                    </div>
                    <form action="{{ route('process.step3') }}" method="POST" class="reg__form login__form">
                        @csrf
                        <p class="title_fz15">Информация о группе</p>
                        <div class="gap-15-20 gap-20 w-100">
                            <div class="users-group">
                                <div class="users-group">


                                    <livewire:registration.reg-country-select />
                                    <livewire:registration.reg-town-select />
                                    <livewire:registration.reg-group-select />
                                    @livewireStyles
                                    @livewireScripts

                                </div>
                            </div>
                        </div>
                        <div class="users-date-member w-100-per_all mt-25-20">
                            <p class="title_fz15_mob">Дата вступления в Школу</p>

                            @php
                                use Carbon\Carbon;

                                $daysInMonth = Carbon::now()->daysInMonth;
                            @endphp

                            <div class="users-date-member-wrapper mt-10">
                                <select name="day" id="daySelect" style="display: none;">
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                <div class="dropdown dropdown--hide dropdown--day">
                                    <div class="dropdown__selected">--</div>
                                    <div class="dropdown__list">
                                        @for ($day = 1; $day <= $daysInMonth; $day++)
                                            <div class="dropdown__item" data-value="{{ $day }}">{{ $day }}</div>
                                        @endfor

                                    </div>
                                </div>
                                <select name="month" id="monthSelect" style="display: none;">

                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endfor
                                </select>
                                <div class="dropdown dropdown--hide ">
                                    <div class="dropdown__selected">--</div>
                                    <div class="dropdown__list">
                                        @for ($month = 1; $month <= 12; $month++)
                                            <div data-value="{{ $month }}" class="dropdown__item">{{ \Carbon\Carbon::create(null, $month)->locale('ru')->isoFormat('MMMM') }}</div>
                                        @endfor
                                    </div>
                                </div>
                                @php
                                    $currentYear = Carbon::now()->year;
                                    $startYear = $currentYear - 30;
                                @endphp
                                <select name="year" id="yearSelect" style="display: none;">
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor

                                </select>
                                <div class="dropdown dropdown--hide">
                                    <div class="dropdown__selected">--</div>
                                    <div class="dropdown__list">
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <div data-value="{{ $year }}" class="dropdown__item">{{ $year }}</div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="login__checkbox">
                                <input name="coordinator" type="checkbox" class="checkbox__box">
                                <p class="text_fz15_mob">я - координатор</p>
                            </div>
                            <div class="reg__btns">
                                <button type="submit" class="reg__btn login__btn btn_dark btn_dark_width">Дальше</button>
                                <button class="reg__back-btn"><a href="{{ route('show.step2') }}">Назад</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </article>
    </div>



    <script src="{{ asset('js/modules/custom-select.js') }}" defer></script>

@endsection

