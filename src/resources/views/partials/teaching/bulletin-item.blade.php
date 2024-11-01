<div class="my-container-border width-50">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <h2 class="teaching__title title_fz18_mob">Бюллетень связи</h2>
        <div class="mt-10-35">
            <b class="mt-10-35">№{{ $bulletinItem->number }}</b>
        </div>
        <div>{{ \Carbon\Carbon::parse($bulletinItem->date)->locale('ru')->isoFormat('MMMM Y') }}</div>
        <p class="mt-10-35">
            {{ $bulletinItem->text }}
        </p>
        <div class="mt-10-35">
            <a href="{{ asset($bulletinItem->url) }}" download>
                <button class="archive__list__btn">Скачать</button>
            </a>
        </div>
        <div class="mt-10-35">
            <a href="{{ route('teaching.bulletin') }}">
                <b>< к списку номеров</b>
            </a>
        </div>
    </div>    
</div>
    
