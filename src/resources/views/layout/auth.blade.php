<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">--}}
    @vite('resources/js/app.js')


</head>

<body class="antialiased">
<div class="auth-wrapper_2">
    <div class="auth-container_2">
        <main class="content_2">
            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
@livewireScripts
<script src="{{ asset('js/modules/tabs.js') }}" defer></script>
<script src="{{ asset('js/main.js') }}" defer></script>
<script src="{{asset('js/modules/custom-select.js')}}" defer></script>

<style>
    .auth-wrapper_2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f8f0e4;
    }
    .auth-container_2 {
        width: 100%;
        max-width: 1220px;
        @media (min-width: 992px) {
            padding: 0 30px;
        }
    }
    .right-part {
        @media (min-width: 992px) {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-left: 310px;
        }
    }
</style>

</body>
</html>
