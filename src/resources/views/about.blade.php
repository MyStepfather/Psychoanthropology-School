@extends('layout.main')

@section('title', 'О школе')

@section('content')

        <section class="about-container my-container content-section">
            <div class="box_content about__title title_fz23_mob mt-4">
                <div class="d-flex title_fz12_mob mt-4 gap-2 gap-lg-4 tab_about">
                    <a href="{{ route('about.show') }}">
                        <div class="tab__btn tab__about-btn @if (request()->is('*about')) tab__btn-active @endif">История
                        </div>
                    </a>

                    <a href="{{ route('about.council.show') }}">
                        <div class="tab__btn tab__about-btn @if (request()->is('*council')) tab__btn-active @endif">
                            Структура и Совет</div>
                    </a>

                    <a href="{{ route('about.contacts.show') }}">
                        <div class="tab__btn tab__about-btn @if (request()->is('*contacts')) tab__btn-active @endif">
                            Контакты</div>
                    </a>
                </div>
            </div>
            <div class="padding-wrapper ">
                @if (request()->is('*about'))
                    <div class="about history-school tab__about-content animate__animated animate__fadeIn">
                        <div class="about__title title_fz23_mob mt-4">
                            О Школе
                        </div>
                        <h2 class="title_fz23_mob mt-5 mt-lg-4">
                            История Школы. <br>
                            Места и основные вехи
                        </h2>
                        <div class="history-school__span ps-4">
                            <h3 class="title_fz18_mob mt-5 ">
                                Сентябрь 1993 <br>
                                Основание Школы Психоантропологии
                            </h3>
                            <div class="mt-3">
                                <img src="{{ asset('img/history_photo.jpg') }}" alt="Селим Айссель">
                            </div>
                            <div class="text_fz15_mob mt-3">
                                От антропологии сознания к Психоантропологии. Встреча СА с Идрисом Шахом в Лондоне.
                            </div>
                            <h3 class="title_fz18_mob mt-5 history-school__point">
                                Октябрь 1994 <br>
                                Покупка поместья в Эйшхоффене. Тюильри
                            </h3>
                            <div class="text_fz15_mob mt-3">
                                Поместье распологается в местах древних скитов, в особом географическом месте в треугольнике
                                между горой Донон и горой святой Одилии.
                            </div>
                            <h3 class="title_fz18_mob mt-5 history-school__point">
                                9 сентября 2004 <br>
                                Ассоциация LAC (Les amis sur le Chemin — Друзья на Пути)
                            </h3>
                            <h3 class="title_fz18_mob mt-5 history-school__point">
                                Июль 2009
                            </h3>
                            <div class="text_fz15_mob mt-3 mb-5">
                                Объявление о начале 5 Пути.
                            </div>
                        </div>
                    </div>
                @endif

                @if (request()->is('*council'))
                    @livewire('about.council-component')
                @endif

                @if (request()->is('*contacts'))
                    <div class="about contact-school tab__about-content animate__animated animate__fadeIn">
                        <div class="about__title title_fz23_mob mt-4">
                            О Школе
                        </div>
                        <h2 class="title_fz23_mob mt-5">
                            Контакты
                        </h2>
                        <h3 class="title_fz18_mob mt-4">
                            Адреса электронной почты для связи со Школой:
                        </h3>
                        <div class="mt-4">
                            <a href="mailto:mail@shkolapa.org?subject=Общие вопросы" class="link-hover font-w">
                                mail@shkolapa.org
                            </a>
                            <div class="mt-2">
                                общие вопросы
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="mailto:reg@shkolapa.org?subject=Общие вопросы" class="link-hover font-w">
                                reg@shkolapa.org
                            </a>
                            <div class="mt-2">
                                регистрация на обучения и стажи
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="mailto:vznos@shkolapa.org?subject=Общие вопросы" class="link-hover font-w">
                                vznos@shkolapa.org
                            </a>
                            <div class="mt-2">
                                бухгалтерия и взносы
                            </div>
                        </div>
                        @include('partials.formToSchool.form_to_school_static')
                    </div>
                @endif
               
            </div>
        </section>

    @include('partials.modals.aboutCouncilsMob')

    @endsection
