@extends('layout.main')
@section('title', 'Мои видео')

@section('content')


    {{--        Отображение на мобильной версии --}}

        <section class="lk content-section">

            <div id="lk-my-video" class="my-video">
                <div class="box_content group__inner title_fz23_mob">
                    <div class="shop__tabs__title title_fz23_mob">Мои видео</div>

                    @include('partials.personal.video_tab', ['myVideo' => $myVideo])


                    <div class="collections-video__wrapper">
                        @if($activeSubscribe)
                            <div class="collections-card no-border"> <!-- карточка сборника -->
                                <a href="{{ route('personal.daily-video.show') }}">
                                    <img class="collections-card__img" src="{{ asset('img/shop/daily-video.png') }}" alt="">
                                    <h2 class="collections-card__title title_fz15">
                                        Подписка на ежедневные беседы
                                    </h2>
                                    <p class="collections-card__descr title_fz12"> Онлайн-видео</p>
                                </a>
                            </div>
                        @endif

                        @if($myVideo)
                                @include('partials.personal.video_element', ['myVideo' => $myVideo])
                        @endif

                    </div>
                </div>
            </div>

        </section>
        <div id="overlay"></div>

    <script src="{{ asset('js/modules/lk.js') }}" defer></script>
{{--    <script src="{{ asset('js/modules/custom-select.js') }}" defer></script>--}}

@endsection
