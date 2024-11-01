@extends('layout.main')
@section('title', 'Все о группах')
@section('content')

        <section class="about-the-groups my-container content-section">
            <div class="box__tabs__wrapper box_content box_content_green title_fz23_mob">
                <div class="box__tabs__title title_fz23_mob">Всё о группах</div> <!-- для мобилок -->
                <div class="box__tabs teaching__tabs title_fz12_mob">
                    <a href="{{route('groups.five-way')}}">
                        <div class="tab__btn teaching__tab @if(request()->is('*/five-way')) teaching__tab-active @endif">5 Пути</div>
                    </a>
                    <a href="{{route('groups.reading')}}">
                        <div class="tab__btn teaching__tab @if(request()->is('*/reading')) teaching__tab-active @endif">Чтения</div>
                    </a>
                    <a href="{{route('groups.beginners')}}">
                        <div class="tab__btn teaching__tab @if(request()->is('*/beginners')) teaching__tab-active @endif">Новичков</div>
                    </a>
                    <a href="{{route('groups.calendar')}}">
                        <div class="tab__btn teaching__tab @if(request()->is('*/calendar')) teaching__tab-active @endif">Календарь групп</div>
                    </a>
                </div>
            </div>
            <div class="my-container-border">
                <div class="padding-wrapper">
                    <h2 class="about-the-groups__header title_fz23_mob hidden-for-mob">Все о группах</h2>
                        @if (request()->is('*/five-way'))
                            @include('partials.aboutSchool.five-way', ['arrFiveWays'=>$arrFiveWays])
                        @endif
                        @if (request()->is('*/reading'))
                            @include('partials.aboutSchool.reading', ['arrReading'=>$arrReading])
                        @endif
                        @if (request()->is('*/beginners'))
                            @include('partials.aboutSchool.beginners', ['arrBeginners'=>$arrBeginners])
                        @endif
                        @if (request()->is('*/calendar'))
                            @include('partials.aboutSchool.calendar', ['arrGroups'=>$arrGroups, 'countries'=>$countries, 'towns'=>$towns])
                        @endif
                </div>
            </div>
        </section>
@endsection
