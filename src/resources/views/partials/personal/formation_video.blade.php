@extends('layout.main')
@section('title', 'Ежедневны видео')

@section('content')


    {{--        Отображение на мобильной версии --}}


        <section class="lk content-section">

            <div id="lk-my-video" class="my-video">
                <div class="box_content group__inner title_fz23_mob">
                    <div class="shop__tabs__title title_fz23_mob">Мои видео</div>

                    @include('partials.personal.video_tab')

                    <div class="collections-video__wrapper">

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
