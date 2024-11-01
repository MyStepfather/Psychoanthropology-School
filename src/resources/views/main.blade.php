@extends('layout.main')
@section('title', 'Главная')

@section('content')
        <section class="main content-section">
            <div class="news box_content">
                <h2 class="title_fz23_mob">Новое на сайте</h2>

                <div id="carouselExampleCaptions" class="carousel carousel-dark slide news__slides" data-bs-ride="carousel">
                    <div class="d-flex justify-content-between">
                        <div class="carousel-indicators align-items-center">
                            @foreach ($news as $index => $item)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide-to="{{ $index }}" class="news__indicator" aria-label="Slide 2">
                                </button>
                            @endforeach
                        </div>

                        <div class="d-flex">
                            <button class="carousel-control-prev dark" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="carousel-inner">
                        @foreach ($news as $item)
                            <div class="news__item carousel-item">
                                <div class="d-lg-flex">
                                    <div class="me-lg-4">
                                        <div class="carousel-caption ">
                                            <h5 class="news__title title_fz18_mob mb-0">{{ $item->title }}</h5>
                                            <p class="news__descr text_fz15_mob d-none d-md-block mb-0">
                                                {{ $item->description }}
                                            </p>
                                        </div>
                                        <a class='btn_white news__btn title_fz12_mob' href="#">Смотреть</a>
                                    </div>
                                    @if ($item->is_video_show)
                                        <video controls class='news__img news__video'>
                                            <source src="{{ Storage::url($item->video_url) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        <div class="news__img">
                                            <img src="{{ Storage::url($item->image_url) }}" class="d-block w-100" alt="...">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <script>
                            const newsIndicator = document.querySelectorAll('.news__indicator');
                            newsIndicator[0].classList.add('active');
                            const newsItems = document.querySelectorAll('.news__item');
                            newsItems[0].classList.add('active');
                        </script>

                    </div>

                </div>

            </div>

            <div class="accordion stans box_content" id="accordionStans">
                <div class="accordion-item stans">
                    <h2 class="accordion-header" id="headingOne">
                        <button id="stansOfWeek" class="title_fz23_mob stans accordion-button collapsed p-0" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseStans" aria-expanded="true"
                            aria-controls="collapseOne">
                            Станс недели
                        </button>
                    </h2>
                    <div id="collapseStans" class="accordion-collapse collapse custom_show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionStans">
                        <div class="accordion-body p-0">
                            <div class="stans_content">
                                @if($stans)
                                    <div class="stans_date title_fz12_mob mt-4">
                                        {{ \Carbon\Carbon::parse($stans->date_start)->locale('ru')->isoFormat('D ') }}-
                                        {{ \Carbon\Carbon::parse($stans->date_end)->locale('ru')->isoFormat('D MMMM') }}
                                    </div>
                                    <div class="stans_name_wrapper d-flex justify-content-between mt-4">
                                        <div class="stans_name title_fz18_mob">
                                            №{{ $stans->number }} {{ $stans->media->mediaTexts->first()->title }}
                                        </div>
                                        <div class="stans_all title_fz12_mob w-75 ms-4">
                                            <a href="{{ route('teaching.songs') }}">
                                                Все стансы
                                            </a>
                                        </div>
                                    </div>
                                    <div class="stans_text text_fz15_mob mt-3">
                                        {!! $stans->media->mediaTexts->first()->text !!}
                                    </div>
                                    <h2 class="title_fz18_mob mt-4">Музыка</h2>
                                    <div class="stans_music_wrapper d-flex justify-content-between flex-wrap gap-3 mt-3">
                                        @foreach ($stans->media->mediaResources as $media)
                                            <div class="stans_music">
                                                <div class="stans_music_name title_fz12_mob align-self-lg-center me-md-4">
                                                    {{ $media->artist->name }}
                                                </div>
                                                <div class="stans_btn_wrapper d-flex align-items-center gap-3 mt-2">
                                                    @livewire('audio-player', ['media' => $media])

                                                    <a href="{{ Storage::url($media->url) }}" download>
                                                        <div class="stans_btn_download">
                                                            <img src="./img/icons/download.svg" alt="Скачать">
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                <p style="margin-top: 20px">Нет активного станса</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="main-wrapper__exercize-event">
                <div class="act_exercise box_content">
                    <h2 class="title_fz23_mob">Актуальное упражнение</h2>
                    <div class="act_exercise_date title_fz15_mob mt-4">{{ \Carbon\Carbon::parse($exercise->date)->locale('ru')->translatedFormat('d F Y') }}</div>
                    <div class="act_exercise_descr text_fz15_mob mt-3">
                        {!! $exercise->text !!}
                    </div>
                    <div class="title_fz12_mob d-flex justify-content-between align-items-center mt-5">
                        <a href="" class="btn_white" data-bs-target="#exercise-actual" data-bs-toggle="modal">
                            Читать описание
                        </a>
                        <a href="{{ route('teaching.tasks') }}" class="btn_text title_fz12_mob pe-2">Все упражнения</a>
                    </div>
                </div>

                <div class="event box_content mt-lg-5">
                    <h2 class="title_fz23_mob">
                        Ближайшее событие
                    </h2>
                    <div class="title_fz18_mob mt-4">
                        {{ \Carbon\Carbon::parse($event->date_start)->locale('ru')->isoFormat('D ') }}-
                        {{ \Carbon\Carbon::parse($event->date_end)->locale('ru')->isoFormat('D MMMM') }}
                        {{ $event->eventType->name }}
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('calendar.show') }}" class="btn_white title_fz12_mob">
                            Календарь
                        </a>
                    </div>
                </div>

            </div>

            <div class="form_to_school_on_page form_to_school box_content mb-5">
                <div class="excludeSelector_on_page excludeSelector collaps_head">
                    <h2 class="title_fz23_mob mod__title">
                        Написать в Школу
                    </h2>
                    <div class="text_fz15_mob mt-3">
                        Если у вас есть вопрос, который вы не можете решить с координатором или друзьями на Пути,
                        напишите его в Школу, мы поможем его разрешить.
                    </div>
                    <label for="topic_form_main" class="mb-2 mt-4 title_fz15_mob">Тема</label>
                    <select id="topic_form_main" class="form-select form_choose_topic"
                        aria-label="Пример выбора по умолчанию">
                        <option selected>Выберите пожалуйста тему</option>
                        <option value="1">Один</option>
                        <option value="2">Два</option>
                        <option value="3">Три</option>
                    </select>
                </div>
                <div class="collaps_body mt-5 animate__animated animate__fadeIn">
                    <div class="title_fz15_mob mb-3">Возможно вам помогут эти статьи</div>
                    <a href="#" class="btn_text">Статья 1111</a> <br>
                    <a href="#" class="btn_text">Статья 2</a>
                    <div class="text_fz15_mob mt-4 mb-3">
                        Если среди предложенного нет нужного ответа, заполните пожалуйста форму
                    </div>
                    <input class="input_txt form-control mb-3 form_custom_topic" type="text" placeholder="Тема"
                        aria-label="пример ввода по умолчанию">
                    <select id="topic_form_main" class="form-select form_to_whom" aria-label="Пример выбора по умолчанию"
                        aria-placeholder="Кому">
                        <option selected>Кому</option>
                        <option value="1">Один</option>
                        <option value="2">Два</option>
                        <option value="3">Три</option>
                    </select>
                    <label for="message_form_main" class="mb-2 mt-4 title_fz15_mob">Сообщение</label>
                    <textarea id="message_form_main" class="area_txt form-control mt-2 form_message" id="exampleFormControlTextarea1"
                        rows="6"></textarea>
                    <div class="btn_dark mt-5">Отправить</div>
                </div>
            </div>
        </section>

    @include('partials.modals.exercise-popup')
    <style>
        .carousel-control-prev-icon {
            background-image: URL({{asset('img/icons/Arrow-left-bold.svg')}}) !important;
        }
        .carousel-control-next-icon {
            background-image: URL({{asset('img/icons/Arrow-right-bold.svg')}}) !important;
        }
    </style>
@endsection
