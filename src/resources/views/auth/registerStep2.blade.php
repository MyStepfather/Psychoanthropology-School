@extends('layout.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="bck-login">
        <article class="reg vh-100">
            <div class="reg__header login__header">
                <img src="{{asset("/img/navbar/logo.svg")}}" alt="" class="login__logo">
                <h1 class="login__name">Школа Психоантропологии</h1>
                <h2 class="reg__title title_fz23">Создание нового аккаунта</h2>
            </div>
            <div class="reg__wrapper login__wrapper box_content box_content_white">
                <div class="reg__content">
                    <div class="reg__steps">
                        <div class="reg__step">
                            <img src="{{asset('img/icons/registration-point.svg')}}" alt="" class="step__img">
                            <h3 class="step__txt title_fz12">Этап 1</h3>
                        </div>
                        <div class="reg__step reg__step_active">
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
                    <form action="{{ route('process.step2') }}" method="POST" enctype="multipart/form-data"
                        class="reg__names login__form mt-0">
                        <p class="title_fz15">Личная информация</p>
                        <div class="gap-15-20 mt-20 login__inputs">
                            @csrf

                            <input name="name_first" type="text" placeholder="Имя"
                                class="login__input users-data__input">
                            @error('name_first')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input name="name_last" type="text" placeholder="Фамилия"
                                class="login__input users-data__input">
                            @error('name_last')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        @livewire('registration.file-uploaded')
                        @livewireStyles
                        @livewireScripts

                        <div class="reg__btns">
                            <button type="submit" class="reg__btn login__btn btn_dark btn_dark_width">Дальше</button>
                            <button class="reg__back-btn"><a href="{{ route('show.step1') }}">Назад</a></button>
                        </div>
                    </form>
                </div>
            </div>

        </article>
    </div>

@endsection
