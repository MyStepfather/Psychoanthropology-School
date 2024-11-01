@extends('layout.auth')

@section('title', 'Авторизация')

@section('content')
    <div class="bck-login">
        <article class="login">
            <div class="login__wrapper box_content box_content_white no-margin">
                <div class="login__header">
                    <img src="{{ asset('img/navbar/logo.svg') }}" alt="" class="login__logo">
                    <h1 class="login__name">Школа Психоантропологии</h1>
                    <h2 class="">сайт для учеников</h2>
                </div>
                <form action="{{ route('login.process') }}" method="POST" class="login__form">
                    <div class="login__inputs">
                        @csrf

                        <input name="email" type="text" placeholder="Почта/логин" class="login__input users-data__input">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        <input name="password" type="password" placeholder="Пароль" class="login__input users-data__input">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <button class="login__btn btn_dark btn_dark_width">Войти</button>
                    <div class="login__checkbox">
                        <input type="checkbox" class="checkbox__box" name="remember">
                        <p class="text_fz15_mob">сохранить данные для входа</p>
                    </div>
                    <div class="login__help">
                        <a href="{{ route('show.reset.password') }}" class="help__pass title_fz15-login">Забыли пароль?</a>
                        <a href="{{ route('show.reset.password') }}" class="help__email title_fz15-login">Забыли почту?</a>
                    </div>
                </form>
            </div>
            <a href="{{ route('show.step1') }}">
                <button class="login__create-btn title_fz12_mob">Создать новый аккаунт</button>
            </a>
            <p class="login__more">Попали на этот сайт случайно? Узнать больше о Школе вы можете на: <a href="http://shkolapa.ru/">shkolapa.ru</a> или <a href="http://epag.org/ru/index.htm">epag.org</a></p>
        </article>
    </div>


@endsection

