@extends('layout.main')
@section('title', 'Учение')
@section('content')

<section id="exercises" class="teaching my-container content-section">
    <!-- Навигационные вкладки -->
    <div class="box__tabs__wrapper box_content box_content_green title_fz23_mob">
        <div class="box__tabs__title title_fz23_mob">Учение</div>
        <div class="box__tabs teaching__tabs title_fz12_mob">
            <a href="{{route('teaching.tasks')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/tasks')) teaching__tab-active @endif ">Упражнения</div>
            </a>
            <a href="{{route('teaching.books')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/books')) teaching__tab-active @endif">Книги</div>
            </a>
            <a href="{{route('teaching.songs')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/songs')) teaching__tab-active @endif">Песни и стансы</div>
            </a>
            <a href="{{route('teaching.bulletin')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/bulletin')) teaching__tab-active @endif">Бюллетень связи</div>
            </a>
            <a href="{{route('teaching.study')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/study')) teaching__tab-active @endif">Обучение и стажи</div>
            </a>
            <a href="{{route('teaching.archive')}}">
                <div class="tab__btn teaching__tab @if(request()->is('*/archive')) teaching__tab-active @endif">Архивные курсы</div>
            </a>
            <a href="{{route('teaching.others')}}">
                <div class="tab__btn teaching__tab">Разное</div>
            </a>
        </div>
    </div>

    <!-- Основной контент страницы -->
    <div class="teaching-content-wrapper" style="display: flex;">
        <!-- Основное содержимое -->
        @if(request()->is('*/tasks'))
            @include('partials.teaching.tasks',['actualTasks' => $actualTasks, 'dailyTasks' => $dailyTasks])
        @endif
        @if(request()->is('*/tasks/*'))
            @include('partials.teaching.tasks-item', ['taskItem'=>$taskItem])
        @endif
        @if(request()->is('*/books'))
            @include('partials.teaching.books',['bookManagers'=>$bookManagers])
        @endif
        @if(request()->is('*/songs'))
            @include('partials.teaching.songs',['stub'=>$stub])
        @endif
        
        @if(request()->is('*/bulletin'))
            @livewire('teaching.bulletin')
        @endif
        @if(request()->is('*/bulletin/*'))
            @include('partials.teaching.bulletin-item', ['bulletinItem'=>$bulletinItem])
        @endif
        @if(request()->is('*/study'))
            @include('partials.teaching.study',['entry_docs'=>$entry_docs])
        @endif
        @if(request()->is('*/archive'))
            @include('partials.teaching.archive',['courses'=>$courses])
        @endif
        @if(request()->is('*/others'))
            @include('partials.teaching.others', ['articles'=>$articles])
        @endif
        @if(request()->is('*/others/*'))
            @include('partials.teaching.others-item', ['articleItem'=>$articleItem])
        @endif        
    </div>
</section>

@endsection
