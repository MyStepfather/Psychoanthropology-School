<h2 class="about-the-groups__title title_fz18_mob">Для групп 5 Пути</h2>
<div class="about-the-groups__items">
    @forelse($arrFiveWays as $item)
        <div class="mb-3">
            <h3 class="title_fz15_mob">Куратор группы: {{ $item['coordinator']['name_first'] }} {{ $item['coordinator']['name_last'] }}</h3>
            <p class="text_fz15_mob">
                {{ \Carbon\Carbon::now()->startOfWeek()->addDays($item['weekday'] - 1)->locale('ru')->isoFormat('dddd') }} в {{ date('H:i', strtotime($item['time'])) }}
            </p>
            <p class="text_fz15_mob">
                {{ $item['town']['name'] }} ({{ $item['country']['name'] }})
            </p>
        </div>
    @empty
        <p class="title_fz18_mob text-center">Нет доступных групп</p>
    @endforelse
</div>





