@extends('layout.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="bck-login">
        <article class="reg vh-100">
            <div class="reg__header login__header">
                <img src="{{ asset('img/navbar/logo.svg') }}" alt="" class="login__logo">
                <h1 class="login__name">Школа Психоантропологии</h1>
                <h2 class="reg__title title_fz23">Создание нового аккаунта</h2>
            </div>
            <div class="reg__wrapper login__wrapper box_content box_content_white">
                <div class="reg__content">
                    <div class="reg__steps">
                        <div class="reg__step reg__step_active">
                            <img src="{{asset('img/icons/registration-point.svg')}}" alt="" class="step__img">
                            <h3 class="step__txt title_fz12">Этап 1</h3>
                        </div>
                        <div class="reg__step">
                            <img src="{{asset('img/icons/registration-point.svg')}}" alt="" class="step__img">
                            <h3 class="step__txt title_fz12">Этап 2</h3>
                        </div>
                        <div class="reg__step">
                            <img src="{{asset('img/icons/registration-point.svg')}}" alt="" class="step__img">
                            <h3 class="step__txt title_fz12">Этап 3</h3>
                        </div>
                        <div class="reg__step">
                            <img src="{{asset('img/icons/registration-point.svg')}}" alt="" class="step__img">
                            <h3 class="step__txt title_fz12">Этап 4</h3>
                        </div>
                    </div>
                    <form action="{{ route('process.step1') }}" method="POST" class="reg__form login__form" novalidate>
                        <p class="login__data title_fz18">Для входа на сайт</p>
                        <div class="gap-15-20 reg__inputs login__inputs">
                            @csrf

                            <input name="email" type="email" placeholder="Почта" class="login__input users-data__input">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            <input name="login" type="login" placeholder="Логин" class="login__input users-data__input">
                                @error('login')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            <input name="password" type="password" placeholder="Пароль" class="login__input users-data__input">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            <input name="password_confirmation" type="password" placeholder="Подтверждение пароля" class="login__input users-data__input">
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                        <p class="reg__note text_fz12_mob">Чтобы аккаунт не был взломан, используйте надежные пароли. Пароль должен содержать не менее 8 символов  (латинские буквы и цифры: как минимум одна заглавная буква и один специальный символ, как @&$!#?)</p>
                        <div class="reg__btns">
                            <button type="submit" class="reg__btn login__btn btn_dark btn_dark_width">Дальше</button>
                            <button class="reg__back-btn"><a href="{{ route('login') }}">Назад</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </div>

@endsection

