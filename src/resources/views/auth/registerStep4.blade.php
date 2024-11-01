@extends('layout.auth')

@section('title', 'Регистрация')

@section('content')
    <div class="bck-login">
        <article class="reg vh-100">
            <div class="reg__header login__header">
                <img src="{{asset('img/navbar/logo.svg')}}" alt="" class="login__logo">
                <h1 class="login__name">Школа Психоантропологии</h1>
                <h2 class="reg__title title_fz23">Создание нового аккаунта</h2>
            </div>
            <div class="reg__wrapper login__wrapper box_content box_content_white">
                <div class="reg__content">
                    <div class="reg__steps">
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h2 class="step__txt title_fz12">Этап 1</h2>
                        </div>
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h2 class="step__txt title_fz12">Этап 2</h2>
                        </div>
                        <div class="reg__step">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h2 class="step__txt title_fz12">Этап 3</h2>
                        </div>
                        <div class="reg__step reg__step_active">
                            <img src="/img/icons/registration-point.svg" alt="" class="step__img">
                            <h2 class="step__txt title_fz12">Этап 4</h2>
                        </div>
                    </div>
                    <form action="{{ route('process.step4') }}" method="POST" class="reg__names login__form mt-0">
                        @csrf
                        <p class="title_fz15">Контактные данные</p>
                        <div class="gap-15-20 mt-20 login__inputs">
                            <input name="phone" type="phone" placeholder="Номер телефона / мессенджера" class="login__input users-data__input">
                            <input name="telegram" type="text" placeholder="Аккаунт в Телеграме" class="login__input users-data__input">
                        </div>
                        <livewire:registration.reg-fourstep/>
                        @livewireScripts
                    </form>
                </div>
            </div>
        </article>
    </div>

@endsection

