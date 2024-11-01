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

            <div class="success__wrapper reg__wrapper login__wrapper box_content box_content_white">
                <p class="title_fz23">Заявка принята!<br>Теперь нужно немного подождать.</p>
                <p class="text_fz15_mob">Данные для регистрации успешно отправлены.
                    После проверки администратором аккаунт будет активен.
                    Обычно это происходит в течение  дня.<br><br>
                    На указанный адрес почты вы получите уведомление об активации и сможете зайти на сайт.
                </p>
            </div>

        </article>
    </div>

@endsection

