{{--@php--}}
{{--dump($uniqueYears);--}}
{{--@endphp--}}
<div
    class="training-video menu__shop__content shop__tab__content animate__animated animate__fadeIn mt-30-10">
    <div class="title_fz18_mob">Обучения</div>
    <div class="training-video__nav">
        <div class="training-video__tabs">
            <button wire:click="tabClickHandler('all')" class="training-video__tab @if ($activeTab === 'all') active @endif">
                Все
            </button>
            @foreach($categories as $key => $value)
                <button wire:click="tabClickHandler('{{$key}}')" class="training-video__tab @if ($activeTab === $key) active @endif">
                    {{$value}}
                </button>
            @endforeach
        </div>
        <div class="date-pick-shop fake-wrapper-list">
            <div>
                <select class="date-picker__years" wire:change="setSelectedYear($event.target.value)">
                    <option {{$selectedYear == 'all'? 'selected' : ''}} value="all">все года</option>
                    @foreach($uniqueYears as $year)
                        <option value="{{$year}}" {{ $year == $selectedYear? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                    <img src="{{ asset('img/icons/arrowDown.svg') }}" alt="" />
                </select>
            </div>
        </div>
    </div>
    <!-- <div class="divider"></div> -->

    <div class="training-video__wrapper">
        @if($filteredProducts->isEmpty())
            <p>Материалы еще не добавлены</p>
        @else
            @foreach ($filteredProducts as $item)
                <div class="video-card"> <!-- карточка видео -->
                    <div class="video-card__upper-part-wrapper title_fz12">
                        <img src="{{ asset($item->cover) }}" alt="" class="video-card__image">
                        <h2 class="video-card__title title_fz15">{{ $item->name }}</h2>
                        <p class="video-card__relise">{{$item->year}}</p>
                        <p class="video-card__type">{!! $item->description !!}</p>
                    </div>
                    <div class="video-card__down-part-wrapper">
                        <div class="video-card__cost-wrapper">
                            <div class="video-card__cost-wrapper__main">
                                <div class="title_fz15_mob">
                                    {{ number_format($item->price, 0, '.', ' ') }}
                                    ₽
                                </div>
                                <div class="text_fz10">общая цена</div>
                            </div>
                            <div class="video-card__cost-wrapper__sale">
                                <div class="title_fz15_mob">
                                    {{ number_format($item->price, 0, '.', ' ') }}
                                    ₽
                                </div>
                                <div class="text_fz10">цена для участников</div>
                            </div>
                        </div>
                        <a class="hidden-for-mob"
                           href="{{ route('shop.product.show', ['id' => $item->id]) }}"
                           data-product-id="{{ $item->id }}">
                            <button class="video-card__btn btn_dark">Подробнее</button>
                        </a>
                        <a class="shop__more-info hide-for-desc" href="#"
                           data-product-id="{{ $item->id }}">
                            <button class="video-card__btn btn_dark">Подробнее</button>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>











