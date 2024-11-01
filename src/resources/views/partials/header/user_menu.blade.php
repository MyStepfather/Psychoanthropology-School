@php
    $user = auth()->user();

@endphp

<div class="header__user-menu user-menu">
    <img src="{{ asset('img/icons/close_modal.svg') }}" alt="" data-userMenu="closeItem" />
    <div class="user-menu__wrapper">
        <div class="user-menu__row">
            <a href="{{ route('personal.show') }}">
                <img style="cursor: pointer"
                    @if ($user->avatar) src="{{ Storage::url($user->avatar) }}" @else src="{{ asset('img/navbar/logo.svg') }}" @endif
                    alt="" />
            </a>
            <p class="user-menu__name">{{ $user->name_first }} {{ $user->name_last }}</p>
            <p class="user-menu__email">{{ $user->email }}</p>
        </div>
        <div class="user-menu__row">
            <div class="user-menu__item" data-userMenu="closeItem">
                <img src="{{ asset('img/navbar/coins.svg') }}" alt="" class="user-menu__ico" />
                <p>Оплаты</p>
            </div>
            <a href="{{ route('settings.main.show') }}">
                <div class="user-menu__item" data-userMenu="closeItem">
                    <svg class="user-menu__ico" width="18" height="19" viewBox="0 0 18 19" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.00001 13.5257C11.1656 13.5257 12.9212 11.6825 12.9212 9.40868C12.9212 7.13489 11.1656 5.29163 9.00001 5.29163C6.83442 5.29163 5.07886 7.13489 5.07886 9.40868C5.07886 11.6825 6.83442 13.5257 9.00001 13.5257Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                            d="M14.6693 5.35168C14.866 5.64731 15.0382 5.96009 15.184 6.28659L17.2998 7.52171C17.564 8.76409 17.5667 10.052 17.3079 11.2957L15.184 12.5308C15.0382 12.8573 14.866 13.1701 14.6693 13.4657L14.7102 16.0131C13.8135 16.8711 12.7522 17.5174 11.5978 17.9087L9.51465 16.5964C9.17199 16.6221 8.82801 16.6221 8.48535 16.5964L6.41041 17.9001C5.25228 17.5159 4.18752 16.8721 3.28982 16.0131L3.33067 13.4743C3.13565 13.1746 2.96356 12.8591 2.81602 12.5308L0.70023 11.2957C0.436041 10.0533 0.433253 8.76534 0.692061 7.52171L2.81602 6.28659C2.96182 5.96009 3.134 5.64731 3.33067 5.35168L3.28982 2.80425C4.1865 1.94633 5.24777 1.29998 6.40224 0.908691L8.48535 2.221C8.82801 2.19527 9.17199 2.19527 9.51465 2.221L11.5896 0.917269C12.7477 1.30144 13.8125 1.94529 14.7102 2.80425L14.6693 5.35168Z"
                            stroke="#102F39" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <p>Настройки</p>
                </div>
            </a>
        </div>
        <div class="user-menu__row">
            <div class="user-menu__item" data-userMenu="closeItem">
                <img src={{ asset('img/icons/logout.svg') }} alt="" class="user-menu__ico" />
                <a href="{{ route('logout') }}">
                    <p>Выйти</p>
                </a>
            </div>
        </div>
    </div>
</div>
