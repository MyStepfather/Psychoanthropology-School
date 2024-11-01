
<div>
    <div class="teaching-exer__dates-wrapper">
        <div class="teaching__slider">
            <a wire:click="decrement" class="teaching__slider__arrows" href="#"><img src="{{asset('/img/icons/Arrow-left.svg')}}" alt=""></a>
            <div class="teaching__slider__content title_fz15_mob">{{$dateDate}}</div>
            <a wire:click="increment" class="teaching__slider__arrows" href="#"><img src="{{asset('/img/icons/Arrow-right.svg')}}" alt=""></a>
        </div>
        <a wire:click="calendarToggle" class="teaching__slider__calendar-pic" href="#"><img src="{{asset('/img/icons/calendar.svg')}}" alt=""></a>

        <div class="datepicker" @if(!$isShown) style="display: none" @endif>

            <div class="datepicker__arrows">
                <span wire:click="previousMonth" class="datepicker__arrow">
                    <img width="15" height="15" src="{{asset('/img/icons/Arrow-left.svg')}}" alt="">
                </span>
                <h1>{{\Carbon\Carbon::parse(\Carbon\Carbon::create($chosenYear,$chosenMonth))->locale('ru')->isoFormat('MMMM')}}</h1>
                <span wire:click="nextMonth" class="datepicker__arrow">
                    <img width="15" height="15" src="{{asset('/img/icons/Arrow-right.svg')}}" alt="">
                </span>
            </div>
            <div class="datepicker__inner">
                <div class="datepicker__days">
                    <div class="datepicker__daysItem">ПН</div>
                    <div class="datepicker__daysItem">ВТ</div>
                    <div class="datepicker__daysItem">СР</div>
                    <div class="datepicker__daysItem">ЧТ</div>
                    <div class="datepicker__daysItem">ПТ</div>
                    <div class="datepicker__daysItem">СБ</div>
                    <div class="datepicker__daysItem">ВС</div>
                </div>
                <div class="datepicker__days">
                    @foreach($daysInMonth as $day)
                        <div wire:click="chooseDay({{json_encode($day)}})" class="datepicker__daysItem @if($day['monthType']=='previous' || $day['monthType']=='next') previous @endif @if($day['hasExercise']) hasExercise @endif  datepicker__daysItem_day">{{$day['day']}}</div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <p id="books" class="teaching-exer__task text_fz15_mob">
        {!!$dateText!!}
    </p>
</div>
