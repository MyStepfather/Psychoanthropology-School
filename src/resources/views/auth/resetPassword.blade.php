@extends('layout.auth')

@section('title', 'Забыли пароль?')

@section('content')
    <div class="bck-login">
        <article class="login">
            <div class="login__wrapper box_content box_content_white no-margin">
                <div class="login__header">
                    <img src="{{ asset('img/navbar/logo.svg') }}" alt="" class="login__logo">
                    <h1 class="login__name">Школа Психоантропологии</h1>
                    <h2 class="">сайт для учеников</h2>
                    <h2 class="reg__title title_fz23">Сброс пароля</h2>
                </div>
                <form action="{{ route('process.reset.password') }}" method="POST" class="login__form">
                    <div class="login__inputs">
                        @csrf

                        <p class="text_fz15_mob">Введите логин или почту</p>
                        <input name="email" type="text" placeholder="Почта/логин" class="login__input users-data__input">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                    </div>
                    <button type="submit" class="login__btn btn_dark btn_dark_width">Отправить</button>
                </form>
            </div>
            <a href="{{ route('show.step1') }}">
                <button class="login__create-btn title_fz12_mob">Создать новый аккаунт</button>
            </a>
            <p class="login__more">Попали на этот сайт случайно? Узнать больше о Школе вы можете на: <a href="http://shkolapa.ru/">shkolapa.ru</a> или <a href="http://epag.org/ru/index.htm">epag.org</a></p>
        </article>
    </div>


@endsection

