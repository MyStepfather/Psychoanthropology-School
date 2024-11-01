@extends('layout.main')

@section('title', 'Магазин')
{{-- @php
    dd($product);
@endphp --}}
@section('content')

    <div class="wrapper page-wrapper">
        <div class="wrapper-fake"></div>

        @include('partials.header.sidebar')

        @include('partials.formToSchool.form_to_school_modal')

        <section class="shop my-container content-section">
            @include('partials.header.header')
            <div class="my-container-border">
                <a href="{{url()->previous()}}" class="to-back hide-for-mob">
                    <img src="{{ asset('img/icons/to_back_arrow.svg') }}" alt="">
                    <h1 class="title_fz15_mob">Назад</h1> <!-- для десктоп -->
                </a>
                <div class="shop-item item__content">
                    <div class="shop-item item__left"><img src="{{ asset($product->cover) }}" alt=""></div>
                    <div class="shop-item item__right">
                        <div class="shop-item item__upper">
                            <h1 class="shop-item item__name">{{ $product->name }}</h1>
                            <div class="shop-item item__select">
                                <div class="date-pick-shop fake-wrapper-list">
                                    <select class="date-picker__years">
                                        <option>{{ $product->price }}</option>
                                        <option>{{ $product->price }}</option>
                                        <option>{{ $product->price }}</option>
                                    </select>
                                </div>
                                <p>общая цена</p>
                            </div>
                            <button class="books-shop-card__btn btn_dark">Купить</button>
                        </div>
                        <div class="shop-item item__downer">
                            <div class="shop-item item__description">
                                <p>FOR129</p>
                                <p>{!! $product->description !!}</p>
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
                </div>
            </div>
        </section>
