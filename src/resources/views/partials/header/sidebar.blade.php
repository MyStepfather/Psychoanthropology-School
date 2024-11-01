<div class="my-navbar" id="navbarSupportedContent">
    <a class="header__logo navbar-brand logo-large"
        @if (!request()->is('*/')) href="{{ route('main.show') }}" @endif>Школа Психоантропологии</a>
    <a class="logo-small_sidebar mb-4" href="{{ route('main.show') }}">
        @php
            $user = auth()->user();
        @endphp
        <img class="me-2" src="{{ asset('img/navbar/logo.svg') }}" alt="Школа">
        <div id="school-nav" class="mt-1 @if (request()->is('*/')) menu_point-active  @endif">Школа</div>
    </a>
    <div class="mb-3 align-self-start">
        <div class="menu_persona">
            <a href="#"><img class="me-2 menu_photo"
                    @if ($user->avatar) src="{{ Storage::url($user->avatar) }}"
                @else src="{{ asset('img/navbar/logo.svg') }}" @endif
                    alt="Школа ПА">
            </a>
            <div class="mt-1">
                <a href="{{ route('personal.show') }}"
                    class="text_fz18 text-decoration-none @if (request()->is('*personal*')) menu_point-active @endif">
                    Личная
                </a>
                <a href="{{ route('personal.my-video.show') }}"
                    class="text_fz15_mob text-decoration-none d-block mt-3 @if (request()->is('*my-video*')) menu_point-active @endif">
                    Мои видео
                </a>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionNavbar">
        <div class="menu-items">
            <div class="accordion-item menu-item-click">
                <h2 class="accordion-header" id="headingOneMenu">
                    <button class="accordion-button collapsed menu-items-txt @if (request()->is('teaching*')) menu_point-active @else collapsed @endif"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOneMenu" aria-expanded="false" aria-controls="collapseOneMenu">
                        Учение
                    </button>
                </h2>
                <div id="collapseOneMenu"
                    class="accordion-collapse collapse @if (request()->is('teaching*')) show @endif"
                    aria-labelledby="headingOneMenu"
                    data-bs-parent="#accordionNavbar">
                    <div class="accordion-body pt-0">
                        <ul class="text_fz15_mob menu_list ps-0 d-flex flex-column gap-3 menu__teaching-tabs">
                            <li class="menu__teaching-tab">
                                <a class="@if (request()->is('*tasks')) menu_point-active @endif"
                                   href="{{ route('teaching.tasks') }}">
                                   Упражнения
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*books')) menu_point-active @endif"
                                    href="{{ route('teaching.books') }}">
                                    Книги
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*songs')) menu_point-active @endif"
                                    href="{{ route('teaching.songs') }}">
                                    Песни и стансы
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*bulletin')) menu_point-active @endif"
                                    href="{{ route('teaching.bulletin') }}">
                                    Бюллетень связи
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*study')) menu_point-active @endif"
                                    href="{{ route('teaching.study') }}">
                                    Обучения и стажи
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*archive')) menu_point-active @endif"
                                    href="{{ route('teaching.archive') }}">
                                    Архив курсов
                                </a>
                            </li>
                            <li class="menu__teaching-tab">
                                <a  class="@if (request()->is('*others')) menu_point-active @endif"
                                    href="{{ route('teaching.others') }}">
                                    Статьи и тексты
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="accordion-item menu-item-click">
                <h2 class="accordion-header" id="headingTwoMenu">
                    <button
                        class="accordion-button menu-items-txt @if (request()->is('about*')) menu_point-active @else collapsed @endif"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoMenu" aria-expanded="false"
                        aria-controls="collapseTwoMenu">
                        О Школе
                    </button>
                </h2>
                <div id="collapseTwoMenu"
                    class="accordion-collapse collapse @if (request()->is('about*')) show @endif"
                    aria-labelledby="headingTwoMenu" data-bs-parent="#accordionNavbar">
                    <div class="accordion-body pt-0">
                        <ul class="text_fz15_mob menu_list ps-0 d-flex flex-column gap-3">
                            <li><a class="@if (request()->is('*about')) menu_point-active @endif"
                                    href="{{ route('about.show') }}">История</a></li>
                            <li><a class="@if (request()->is('*council')) menu_point-active @endif"
                                    href="{{ route('about.council.show') }}">Структура Школы и Совет</a></li>
                            <li><a class="@if (request()->is('*contacts')) menu_point-active @endif"
                                    href="{{ route('about.contacts.show') }}">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="accordion-item menu_item menu-item-click">
                <a href="{{ route('calendar.show') }}" class="menu-items-txt @if (request()->is('*calendar')) menu_point-active @endif">Календарь</a>
            </div>
            <div class="divider"></div>

            <div class="accordion-item menu-item-click">
                <h2 class="accordion-header" id="headingThreeMenu">
                    <button class="accordion-button collapsed menu-items-txt" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThreeMenu" aria-expanded="false" aria-controls="collapseThreeMenu">
                        Всё о группах
                    </button>
                </h2>
                <div id="collapseThreeMenu" class="accordion-collapse collapse @if (request()->is('groups*')) show @endif" aria-labelledby="headingThreeMenu"
                    data-bs-parent="#accordionNavbar">
                    <div class="accordion-body pt-0">
                        <ul class="text_fz15_mob menu_list ps-0 d-flex flex-column gap-3">
                            <li>
                                <a class="@if (request()->is('*/five-way')) menu_point-active @endif"
                                   href="{{ route('groups.five-way') }}">
                                    5 Пути
                                </a>
                            </li>
                            <li>
                                <a class="@if (request()->is('*/reading')) menu_point-active @endif"
                                   href="{{ route('groups.reading') }}">
                                    Чтения
                                </a>
                            </li>
                            <li>
                                <a class="@if (request()->is('*/beginners')) menu_point-active @endif"
                                   href="{{ route('groups.beginners') }}">
                                    Новичков/Открытия
                                </a>
                            </li>
                            <li>
                                <a class="@if (request()->is('*/calendar')) menu_point-active @endif"
                                   href="{{ route('groups.calendar') }}">
                                    Календарь Групп
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="accordion-item menu-item-click">
                <h2 class="accordion-header" id="headingFourMenu">
                    <button
                        class="accordion-button collapsed menu-items-txt @if (request()->is('shop*')) menu_point-active @else collapsed @endif"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourMenu"
                        aria-expanded="false" aria-controls="collapseFourMenu">
                        Магазин
                    </button>
                </h2>
                <div id="collapseFourMenu"
                    class="accordion-collapse collapse @if (request()->is('shop*')) show @endif"
                    aria-labelledby="headingFourMenu" data-bs-parent="#accordionNavbar">
                    <div class="accordion-body pt-0">
                        <ul class="text_fz15_mob menu_list ps-0 d-flex flex-column gap-3 menu__shop-tabs">
                            <li class="menu__shop-tab"><a
                                    class="@if (request()->is('*daily-video')) menu_point-active @endif"
                                    href="{{ route('shop.dailyVideo.show') }}">Ежедневные видео</a></li>
                            <li class="menu__shop-tab"><a
                                    class="@if (request()->is('*teaching')) menu_point-active @endif"
                                    href="{{ route('shop.teaching.show') }}">Обучения</a></li>
                            <li class="menu__shop-tab"><a
                                    class="@if (request()->is('*collections')) menu_point-active @endif"
                                    href="{{ route('shop.collections.show') }}">Сборники</a>
                            </li>
                            <li class="menu__shop-tab"><a
                                    class="@if (request()->is('*books')) menu_point-active @endif"
                                    href="{{ route('shop.books.show') }}">Книги</a></li>
                            <li class="menu__shop-tab"><a
                                    class="@if (request()->is('*archive')) menu_point-active @endif"
                                    href="{{ route('shop.archive.show') }}">Архивные курсы</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="divider"></div> -->
            </div>
        </div>
        <button class="header__nav-btn btn_white title_fz12_mob" data-bs-toggle="modal"
            data-bs-target="#form_to_school_modal">Написать в школу</button>
    </div>
</div>
