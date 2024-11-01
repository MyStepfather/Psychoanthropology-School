@php
    $user = auth()->user();
@endphp
<header class="header">
    <div class="header__container header__container_not-paid @if(request()->is('personal*')) header--personal @endif">
        <div class="header__nav header__nav_bord">
            <a href="/">
                <div class="header__nav-item @if (request()->is('*/')) header__nav-item--active @endif menu_point-active">
                    <img class=""  src="{{ asset('img/navbar/logo.svg') }}" alt="Школа">
                    Школа
                </div>
            </a>
            <a href="{{ route('personal.show') }}">
                <div id="lk-nav-item" class="header__nav-item @if (request()->is('personal*')) header__nav-item--active @endif">
                    <img class=" menu_photo" @if ($user->avatar) src="{{ Storage::url($user->avatar) }}"
                         @else src="{{ asset('img/navbar/logo.svg') }}" @endif alt="Личная">
                    Личная
                </div>
            </a>
        </div>
        @if (request()->is('personal*'))
            <div class="not-paid__inner paid-vis">
                <div class="not-paid__left-part">
                    <svg style="color: white" width="27" height="26" viewBox="0 0 27 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.5156 12.1875C15.0029 12.1875 18.6406 10.5505 18.6406 8.53125C18.6406 6.51196 15.0029 4.875 10.5156 4.875C6.02831 4.875 2.39062 6.51196 2.39062 8.53125C2.39062 10.5505 6.02831 12.1875 10.5156 12.1875Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M2.39062 8.53125V12.5937C2.39062 14.6148 6.02656 16.25 10.5156 16.25C15.0047 16.25 18.6406 14.6148 18.6406 12.5937V8.53125"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.26562 11.8828V15.9453" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M18.6406 9.82104C22.3477 10.1664 25.1406 11.639 25.1406 13.4062C25.1406 15.4273 21.5047 17.0625 17.0156 17.0625C15.025 17.0625 13.1969 16.7375 11.7852 16.2093"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M8.89062 16.1789V17.4687C8.89062 19.4898 12.5266 21.125 17.0156 21.125C21.5047 21.125 25.1406 19.4898 25.1406 17.4687V13.4062"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M20.2656 16.7578V20.8203" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M13.7656 11.8828V20.8203" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                    <p class="not-paid__txt">У вас не оплачено 2 месяца</p>
                </div>
                <button class="not-paid__btn btn_white title_fz12_mob">Оплатить</button>
            </div>
        @endif

        <div class="nav-icons">
            <a href="#"><img src="{{ asset('img/navbar/basket.svg') }}" alt="Корзина"></a>
            <a href="#"><img src="{{ asset('img/navbar/search.svg') }}" alt="Поиск"></a>
            <a class="nav-coins nav-icon tooltip-money" href="#">
                <img src="{{ asset('img/navbar/coins.svg') }}" alt="Взносы">
                <div class="count-coins">2</div>
                <span class="tooltiptext">У вас задолженность 2 месяца: январь 2023, май 2023</span>
            </a>
            <img id="userMenuIco" class="nav-icon" src="{{ asset('img/navbar/men.svg') }}" alt="Настройки">
        </div>
    </div>
    <div class="burger">
        <div class="burger__icon"></div>
    </div>
    @include('partials.header.user_menu')
</header>
