@extends('layout.main')
@section('title', 'Ежедневны видео')

@section('content')


    {{--        Отображение на мобильной версии --}}

        <section class="lk content-section">

            @livewire('personal.daily-video')
            @livewireStyles
            @livewireScripts

        </section>
        <div id="overlay"></div>




    <script src="{{ asset('js/modules/lk.js') }}" defer></script>
{{--    <script src="{{ asset('js/modules/custom-select.js') }}" defer></script>--}}

@endsection
