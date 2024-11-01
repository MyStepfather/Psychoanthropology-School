<div class="my-video__tabs-mob title_fz12 mt-20-10">

    <a href="{{ route('personal.my-video.show') }}">
        <div class="tab__btn
        @if(request()->is('*my-video')) tab__btn-active @endif">
            Все
        </div>
    </a>

    <a href="{{ route('personal.daily-video.show') }}">
        <div class="tab__btn
            @if(request()->is('*daily*')) tab__btn-active @endif">
            Ежедневные
        </div>
    </a>

    <a href="{{ route('personal.formation-video.show') }}">
        <div class="tab__btn
        @if(request()->is('*formation*')) tab__btn-active @endif">
            Обучения
        </div>
    </a>


    <a href="{{ route('personal.stage-video.show') }}">
        <div class="tab__btn
        @if(request()->is('*stage*')) tab__btn-active @endif">
            Стажи
        </div>
    </a>

    <a href="{{ route('personal.collection-video.show') }}">
        <div class="tab__btn
        @if(request()->is('*collection*')) tab__btn-active @endif">
            Сборники
        </div>
    </a>

</div>
