<div>
    <div class="everyday-video">
        <div class="box_content group__inner title_fz23_mob">
            <div class="shop__tabs__title title_fz23_mob hidden-for-desk">Ежедневные видео</div>
            <!-- мобилка -->
            <div class="everyday-video__title hidden-for-mob">Мои видео</div> <!-- деск -->

            @include('partials.personal.video_tab')


                <div class="everyday-video__tabs-wrapper mt-20">

                    <div class="tabs-2022 everyday-video__years mb-3">
                        @foreach($periods as $year => $months)
                            <p class="title_fz12
                            @if ($year == $selectedYear) everyday-video__tab-active @endif"
                            wire:click="updateSelectedYear({{ $year }})">
                                {{ $year }}
                            </p>
                        @endforeach
                    </div>
                    <div class="everyday-video__months title_fz12">
                        @foreach($periods as $year => $months)
                            @foreach($months as $month)
                                @if ($year == $selectedYear && $month === 1)
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                     wire:click="updateSelectedMonth({{ $month }})">
                                        Январь
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 2)
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Февраль
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 3)
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Март
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 4 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Апрель
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 5 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month === $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Май
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 6 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month === $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Июнь
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 7 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Июль
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 8 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Август
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 9)
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Сентябрь
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 10 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Октябрь
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 11 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Ноябрь
                                    </div>
                                @endif
                                @if ($year == $selectedYear && $month == 12 )
                                    <div class="tab__btn everyday-video__tab
                                     @if ($month == $selectedMonth) everyday-video__tab-active @endif"
                                         wire:click="updateSelectedMonth({{ $month }})">
                                        Декабрь
                                    </div>
                                @endif
                                    {{--                                <div class="tab__btn everyday-video__tab everyday-video__tab-active">--}}
                                    {{--                                    {{ \Carbon\Carbon::createFromDate(null, $month, 1)->locale('ru')->isoFormat('MMMM') }}--}}
                                    {{--                                </div>--}}

                            @endforeach
                        @endforeach
                    </div>


{{--                    <div class="tabs-2023 everyday-video__years">--}}
{{--                        <p class="title_fz12">2023</p>--}}
{{--                        <div class="everyday-video__months title_fz12">--}}
{{--                            <div class="tab__btn everyday-video__tab everyday-video__tab-active">Январь</div>--}}
{{--                            <div class="tab__btn everyday-video__tab">февраль</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


            <div class="everyday-video__wrapper">
                @if($videos)
                    @foreach($videos as $video)
                    <div class="everyday-video__item">
                        <p class="everyday-video__date font-w">
                            {{ \Carbon\Carbon::parse($video->date)->locale('ru')->isoFormat('D MMMM YYYY') }}
                        </p>
                        <div class="everyday-video__description">
                            <p class="everyday-video__subtitle font-w">
                                {{ $video->name }}
                            </p>
                            <button class="everyday-video__download">
                                <img src="{{ asset('img/icons/download.svg') }}"  alt="">
                            </button>
                        </div>
                        <div class="everyday-video__video-wrapper">
                            {!! $video->url !!}
{{--                            <img class="everyday-video__video" src="{{ asset('img/Preview_video.png') }}" alt="">--}}
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
