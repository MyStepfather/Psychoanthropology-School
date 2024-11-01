@php
    $user = auth()->user();

    if ($user->social) {
        $social = json_decode($user->social);

        $userInst = isset($social->instagram) ? $social->instagram : 'Добавьте свой Instagram';
        $userVk = isset($social->vk) ? $social->vk : 'Добавьте свой ВК';
    } else {
        $userVk = 'Добавьте свой ВК';
        $userInst = 'Добавьте свой Instagram';
    }
@endphp

<div class="users-contacts">
    <div class="my-settings__header-wrapper">
        <img src="assets/img/icons/Arrow-left.svg" alt="" class="my-settings__back">
        <div class="my-settings__title title_fz23_mob">Контакты</div>
    </div>
    <form method="POST" action="{{ route('changeContacts') }}" class="users-data__wrapper">
        @csrf
        <div class="users-data__input-wrapper users-data__input-wrapper_column">
            <label for="phone" class="users-data__label">Номер телефона / мессенджера</label>
            <input type="text" name='phone' id="phone" placeholder="{{$user->phone}}"
                class="users-data__input users-data__input--wide">
        </div>
        <div class="users-dara__social-webs">
            <div class="users-data__input-wrapper users-data__input-wrapper_column">
                <label for="vk" class="users-data__label">Аккаунты социальных сетей</label>
                <input type="text" name="vk" id="vk" placeholder="{{ $userVk }}"
                    class="users-data__input users-data__input--wide">
                <input type="text" name="instagram" id="instagram" placeholder="{{ $userInst }}"
                    class="users-data__input users-data__input--wide">
            </div>
            {{-- <button class="btn_white users-photo__white-btn mt-15">Добавить</button> --}}
        </div>
        <div class="checkbox__wrapper">
            <input type="checkbox" name="is_public" value="0" class="checkbox__box" id="publicCheckbox"
                onchange="updateCheckboxValue(this)" @if ($user->is_public) checked @endif>
            <label for="publicCheckbox" class="checkbox__label">открыть данные для публикации на сайте (видимы для
                других пользователей)</label>
        </div>
        <button type="submit" class="btn_dark btn_dark_width mt-20">Сохранить</button>
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
<script>
    function updateCheckboxValue(checkbox) {
        if (checkbox.checked) {
            document.getElementsByName('is_public')[0].value = 1;
            checkbox.classList.add('checked');
        } else {
            document.getElementsByName('is_public')[0].value = 0;
            checkbox.classList.remove('checked');
        }
    }
</script>
