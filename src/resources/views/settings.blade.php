@extends('layout.main')

@section('title', 'Настройки')

@section('content')

    <div class="my-container-border bgc-wt-mob">
        <h2 class="my-settings__label title_fz23_mob">Мои настройки</h2>
        <!-- Для десктопа -->
        <div class="my-settings__tabs hidden-desk">
            <a href="{{ route('settings.main.show') }}">
                <div
                    class="tab__btn my-settings__tab @if (request()->is('*main')) my-settings__tab-active @endif">
                    <img src={{ asset('img/icons/UserList.svg') }} alt="" class="my-settings__tab-pic">
                    <div class="my-settings__tab-name">Личные данные</div>
                </div>
            </a>
            <a href="{{ route('settings.login.show') }}">
                <div
                    class="tab__btn my-settings__tab @if (request()->is('*login')) my-settings__tab-active @endif">
                    <img src={{ asset('img/icons/Key.svg') }} alt="" class="my-settings__tab-pic">
                    <div class="my-settings__tab-name">Данные для входа</div>
                </div>
            </a>
            <a href="{{ route('settings.membership.show') }}">
                <div
                    class="tab__btn my-settings__tab @if (request()->is('*membership')) my-settings__tab-active @endif">
                    <img src={{ asset('img/icons/UsersFour.svg') }} alt="" class="my-settings__tab-pic">
                    <div class="my-settings__tab-name">Членство в Школе</div>
                </div>
            </a>
            <a href="{{ route('settings.contacts.show') }}">
                <div
                    class="tab__btn my-settings__tab @if (request()->is('*contacts')) my-settings__tab-active @endif">
                    <img src={{ asset('img/icons/PaperPlaneTilt.svg') }} alt=""
                        class="my-settings__tab-pic">
                    <div class="my-settings__tab-name">Контакты</div>
                </div>
            </a>
        </div>
        <!-- Для мобилки -->
        <div class="my-settings__mob">
            <div class="my-settings__item">
                <img src={{ asset('img/icons/UserList.svg') }} alt="" class="my-settings__pic">
                <div class="my-settings__name title_fz15_mob">Личные данные</div>
            </div>
            <div class="my-settings__item">
                <img src={{ asset('img/icons/Key.svg') }} alt="" class="my-settings__pic">
                <div class="my-settings__name title_fz15_mob">Данные для входа</div>
            </div>
            <div class="my-settings__item">
                <img src={{ asset('img/icons/UsersFour.svg') }} alt="" class="my-settings__pic">
                <div class="my-settings__name title_fz15_mob">Членство в Школе</div>
            </div>
            <div class="my-settings__item">
                <img src={{ asset('img/icons/PaperPlaneTilt.svg') }} alt="" class="my-settings__pic">
                <div class="my-settings__name title_fz15_mob">Контакты</div>
            </div>
        </div>
        @if (request()->is('*main'))
            @include('partials.settings.main-settings')
        @endif
        @if (request()->is('*login'))
            @include('partials.settings.login-settings')
        @endif
        @if (request()->is('*membership'))
            @include('partials.settings.membership-settings')
        @endif
        @if (request()->is('*contacts'))
            @include('partials.settings.contacts-settings')
        @endif
    </div>
    <style>
        .dropdown::after {
            content: url("{{ asset('img/icons/select-arrow.svg') }}");
        }
    </style>
@endsection
