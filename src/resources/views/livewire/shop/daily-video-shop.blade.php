<div class="video menu__shop__content shop__tab__content animate__animated animate__fadeIn mt-30-10">
    <div class="video__title title_fz18_mob padding-wrapper">Ежедневные видео</div>
    <div class="video__desc text_fz15_mob mt-10-35 padding-wrapper">
        Ежедневные видео продаются по подписке от одного месяца. После оплаты на личной странице появляется раздел с видео и возможностью скачать аудио. Доступ к записям сохраняется в течение трех месяцев.
    </div>
    <div class="video__sub-wrapper mt-30-35 padding-wrapper">
        <div class="text_fz15_mob">Есть два варианта подписки:</div>
        <ul>
            <li style="list-style:disc;" class="video__sub-i">видео в записи</li>
            <li style="list-style:disc;" class="video__sub-i">видео в записи + возможность участия онлайн</li>
        </ul>
        <div class="video__sub-note text_fz15_mob mt-30-35">Отчет начинается с текущего месяца.</div>
    </div>
    <div class="subscribe mt-30-35">
        <div class="subscribe__wrapper">
            <div class="subscribe__title title_fz18">Запись видео</div>
            <div class="subscribe__cost text_fz15_mob">{{ $price_video }}/месяц</div>
            <div class="subscribe__months">
                <div class="title_fz12_mob">Количество месяцев</div>
                <div class="subscribe__months__nav-wrapper">
                    <!-- Добавляем wire:click директивы -->
                    <button class="subscribe__minus" wire:click="decrementVideo">-</button>
                    <div class="subscribe__q">{{ $months_video }}</div>
                    <button class="subscribe__plus" wire:click="incrementVideo">+</button>
                </div>
            </div>
            <div class="subscribe__sum title_fz15_mob">Итого: {{ $total_video }}</div>
            <button class="subscribe__btn btn_dark">В корзину</button>
        </div>
        <div class="subscribe__wrapper">
            <div class="subscribe__title title_fz18">Запись+ZOOM</div>
            <div class="subscribe__cost text_fz15_mob">{{ $price_zoom }}/месяц</div>
            <div class="subscribe__months">
                <div class="title_fz12_mob">Количество месяцев</div>
                <div class="subscribe__months__nav-wrapper">
                    <!-- Добавляем wire:click директивы -->
                    <button class="subscribe__minus" wire:click="decrementZoom">-</button>
                    <div class="subscribe__q">{{ $months_zoom }}</div>
                    <button class="subscribe__plus" wire:click="incrementZoom">+</button>
                </div>
            </div>
            <div class="subscribe__sum title_fz15_mob">Итого: {{ $total_zoom }}</div>
            <button class="subscribe__btn btn_dark">В корзину</button>
        </div>
    </div>
</div>
