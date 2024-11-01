@extends('layout.main')

@section('title', 'Магазин')

@section('content')

        <section class="shop my-container content-section">
            <div class="box__tabs__wrapper box_content box_content_green title_fz23_mob">
                <div class="shop__tabs__title title_fz23_mob">Магазин</div> <!-- для мобилок -->
                <div class="shop__tabs__wrapper shop__tabs">
                    <div class="shop__tabs__wrapper-1 title_fz12_mob">
                        <div class="text_fz15_mob">Посмотреть</div>
                        <div class="tabs__mob title_fz12_mob">
                            <a href="{{ route('shop.dailyVideo.show') }}">
                                <div class="tab__btn shop__tab @if (request()->is('*dailyVideo')) shop__tab-active @endif">
                                    Ежедневные видео</div>
                            </a>
                            <a href="{{ route('shop.teaching.show') }}">
                                <div class="tab__btn shop__tab @if (request()->is('*teaching')) shop__tab-active @endif">
                                    Обучения</div>
                            </a>
                            <a href="{{ route('shop.collections.show') }}">
                                <div class="tab__btn shop__tab @if (request()->is('*collections')) shop__tab-active @endif">
                                    Сборники</div>
                            </a>
                        </div>
                    </div>
                    <div class="shop__tabs__wrapper-2 title_fz12_mob">
                        <div class="text_fz15_mob">Почитать</div>
                        <div class="tabs__mob title_fz12_mob">
                            <a href="{{ route('shop.books.show') }}">
                                <div class="tab__btn shop__tab @if (request()->is('*books')) shop__tab-active @endif">
                                    Книги
                                </div>
                            </a>
                            <a href="{{ route('shop.archive.show') }}">
                                <div class="tab__btn shop__tab @if (request()->is('*archive')) shop__tab-active @endif">
                                    Архивные курсы</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-container-border">
                <h1 class="shop__header title_fz30">Магазин</h1> <!-- для десктоп -->
                    @if (request()->is('*daily-video'))
                    @livewire('shop.daily-video-shop')
                    @endif

                @if (request()->is('*teaching'))
                    @livewire('shop.teaching')
                @endif

                @if (request()->is('*collections'))
                    <div
                        class="сollections-video menu__shop__content shop__tab__content animate__animated animate__fadeIn mt-30-10">
                        <div class="title_fz18_mob">Сборники</div>
                        <div class="collections-video__wrapper">
                            @foreach ($collections as $collection)
                                <div class="collections-card"> <!-- карточка сборника -->
                                    <div class="collections-card__upper-part-wrapper title_fz12_mob">
                                        <a href=""><img class="collections-card__img"
                                                src="{{ asset($collection->cover) }}" alt=""></a>
                                        <h2 class="collections-card__title title_fz15">{{ $collection->name }}</h2>
                                        <p class="collections-card__descr">{!! $collection->description !!}</p>
                                    </div>
                                    <div class="collections-card__downer-part-wrapper">
                                        <div class="collections-card__cost title_fz15">
                                            {{ number_format($collection->price, 0, '.', ' ') }} ₽</div>
                                        <button class="collections-card__btn btn_dark">В корзину</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (request()->is('*books'))
                    <div
                        class="books-shop-shop menu__shop__content shop__tab__content animate__animated animate__fadeIn mt-30-10">
                        <div class="title_fz18_mob">Книги</div>
                        <div class="books-shop__wrapper">
                            @foreach ($books as $book)
                                <div class="books-shop-card"> <!-- карточка книги -->
                                    <div class="books-shop-card__upper-part-wrapper">
                                        <a href=""><img src="{{ asset($book->cover) }}" alt=""
                                                class="books-shop-card__img"></a>
                                        <h2 class="books-shop-card__title title_fz15">
                                            {{ $book->artist_name }}<br>{{ $book->name }}</h2>
                                    </div>
                                    <div class="books-shop-card__downer-part-wrapper">
                                        <div class="books-shop-card__cost title_fz15">
                                            {{ number_format($book->price, 0, '.', ' ') }} ₽</div>
                                        <button class="books-shop-card__btn btn_dark">В корзину</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (request()->is('*archive'))
                @livewire('shop.archive-shop')
                @endif
            </div>
        </section>
        <div class="shopItemModal">
            @livewire('shop-item-modal')
        </div>
@endsection

<script>
    const shopItems = document.querySelectorAll(".shop__more-info");
    shopItems.forEach((item) => {
        item.addEventListener('click', (event) => {
            event.preventDefault();

            const productId = item.dataset.productId;
            console.log(productId);

            const shopItemModal = document.querySelector(".shopItemModal");
            shopItemModal.classList.add('active');

            Livewire.emit('loadProduct', productId);
        });
    });
</script>
<style>
    .shopItemModal {
        position: fixed;
        padding: 30px 20px;
        border-radius: 15px;
        background-color: #fff;
        width: 90%;
        height: auto;
        z-index: 300;
        transition: 0.2s;
        display: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .shopItemModal.active {
        display: block;
    }
</style>
