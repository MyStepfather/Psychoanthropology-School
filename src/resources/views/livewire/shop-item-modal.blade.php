<div class="shop-item item__content">http://localhost:700/favicon.ico
    <div class="shop-item item__upper">
        <div class="shop-item item__left"><img src="{{ asset($product?->cover) }}" alt=""></div>
        <div class="shop-item item__right">
            <h1 class="shop-item item__name">{{ $product?->name }}</h1>
            <div class="shop-item item__select">
                <div class="date-pick-shop fake-wrapper-list">
                    <select class="date-picker__years">
                        <option>{{ $product?->price }}</option>
                        <option>{{ $product?->price }}</option>
                        <option>{{ $product?->price }}</option>
                    </select>
                </div>
                <p>общая цена</p>
            </div>
            <button class="books-shop-card__btn btn_dark">Купить</button>
        </div>
    </div>
    <div class="shop-item item__downer">
        <div class="shop-item item__description">
            <p>FOR129</p>
            <p>{!! $product?->description !!}</p>
        </div>
        <p class="shop-item item__description">При покупке неограниченный доступ на 5 лет</p>
        <div class="shop-item item__themes">
            <p class="title_fz18">Темы</p>
            <ul>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
                <li class="text_fz15_mob">Три категории слушателей ПА</li>
            </ul>
        </div>
    </div>
</div>
