<div class="archive menu__shop__content shop__tab__content animate__animated animate__fadeIn mt-30-10 padding-wrapper">
    <h2 class="teaching__title title_fz18_mob">Архивные курсы</h2>
    <p class="archive__descr text_fz15_mob mt-10-35">
        В архиве собраны все курсы ПА, переведенные на русский язык.
        Ученику автоматически открывается доступ к курсам, которые были прочитаны им за время нахождения в составе Школы
        <span>( отмечены <span class="green-ball"></span>&emsp;&ensp;)</span>.
    </p>

    @if($courses->isEmpty())
        <p>Материалы еще не добавлены</p>
    @else
        <div class="archive__slider teaching__slider">
            <a href="#" 
               wire:click.prevent="previousPage" 
               class="{{ $isPrevDisabled ? 'disabled' : '' }}">
                <img src="{{ asset('img/icons/Arrow-left.svg') }}" alt="">
            </a>
            <div class="teaching__slider__content title_fz15_mob">
                {{ $minCourseNumber }} - {{ $maxCourseNumber }}
            </div>
            <a href="#" 
               wire:click.prevent="nextPage" 
               class="{{ $isNextDisabled ? 'disabled' : '' }}">
                <img src="{{ asset('img/icons/Arrow-right.svg') }}" alt="">
            </a>
        </div>

        <form action="#">
            <ol class="archive__list">
                @foreach($courses as $course)
                    <li><input type="checkbox" class="checkboxes">{{ $course->number }}: {{ $course->name }}</li>
                @endforeach
            </ol>
        </form>
    @endif
</div>

<style>
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
</style>

