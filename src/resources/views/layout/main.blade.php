<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @vite('resources/js/app.js')
    <script src="//unpkg.com/alpinejs" defer></script>

{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">--}}
</head>

<body class="antialiased">
    <div class="page-wrapper_2">
        <div class="container_2">
            <div class="content-wrapper">
                <div class="sidebar-wrapper">
                    @include('partials.header.sidebar')
                </div>
                <div class="right-part">
                    @include('partials.header.header')
                    <main class="content_2">
                        @yield('content')
                    </main>
                </div>
            </div>

            @include('partials.footer')
            @include('partials.formToSchool.form_to_school_modal')
        </div>
    </div>

    @livewireScripts

    @if(request()->path() == 'settings/main' ||
        request()->path() == 'settings/membership'
    )
        <script src="{{asset('js/modules/custom-select.js')}}" defer></script>
    @endif

    <style>
        .page-wrapper_2 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container_2 {
            width: 100%;
            max-width: 1220px;
            padding: 0 10px;
            @media (min-width: 992px) {
                padding: 0 30px;
            }
        }
        .content-wrapper {
            display: block;
            @media (min-width: 992px) {
                display: flex;
                flex-direction: row;
                gap: 20px;
            }
            @media (min-width: 1115px) {
                gap: 70px;
            }
        }
        .right-part {
            @media (min-width: 992px) {
                display: flex;
                flex-direction: column;
                gap: 0;
                width: 100%;
            }
        }

        .content_2 {
            padding-top: 100px;
            @media (min-width: 992px) {
                padding: unset;
            }
        }
    </style>

</body>
</html>
