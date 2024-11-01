@php
    $user = auth()->user();
@endphp

<div class="users-login">
    <div class="my-settings__header-wrapper">
        <img src="assets/img/icons/Arrow-left.svg" alt="" class="my-settings__back">
        <div class="my-settings__title title_fz23_mob">Данные для входа</div>
    </div>
    <form method="POST" action="{{ route('changeEmail') }}" class="users-data__wrapper users-login__inputs-wrapper">
        @csrf
        <div class="users-data__input-wrapper users-login__inputs-wrapper">
            <label for="email" class="users-data__label">Эл. почта</label>
            <input type="email" id="users-email" name="email" placeholder="{{ $user->email }}"
                class="users-data__input">
        </div>
        <button type="submit" class="users-data__btn btn_dark btn_dark_width">Сохранить</button>
    </form>
    <form method="POST" action="{{ route('changePassword') }}" class="users-data__wrapper users-login__inputs-wrapper">
        @csrf
        <div class="users-data__inputs-wrapper">
            <div class="title_fz15">Пароль</div>
            <div class="users-data__wrapper">
                <div class="users-data__input-wrapper">
                    <label for="current-password" class="users-data__label">Текущий</label>
                    <input type="password" id="users-current-password" name="current-password"
                        placeholder="••••••••••••" class="users-data__input">
                </div>
                <div class="users-data__input-wrapper">
                    <label for="new-password" class="users-data__label">Новый</label>
                    <input type="password" id="users-new-password" name="new-password" placeholder="••••••••••••"
                        class="users-data__input">
                </div>
            </div>
        </div>
        <button type="submit" class="users-data__btn btn_dark btn_dark_width">Сохранить</button>
    </form>
</div>
@if($errors->any())
    <div class="mt-4 alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('success'))
    <div class="mt-4 alert alert-success">
        {{ session('success') }}
    </div>
@endif
