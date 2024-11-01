<div class="teaching-exer__months">
    @if($actualTasks && $actualTasks->count() > 0)
        @foreach($actualTasks as $actualTask)
            <a href="#" class="first-letter-uppercase" wire:click.prevent="showTaskDetails({{ $actualTask['id'] }})">
                {{ mb_convert_case(\Carbon\Carbon::parse($actualTask['date'])->locale('ru')->isoFormat('MMMM Y'), MB_CASE_TITLE, "UTF-8") }}. {{ $actualTask['title'] }}
            </a>
        @endforeach
    @else
        <p>Материалы еще не добавлены</p>
    @endif
</div>

<!-- Отображение выбранного шаблона задачи -->
<div class="song-details-container">
    @if($actualTask)
        <livewire:teaching.song-item :id="$currentTaskId" :type="'task'" />
    @endif
</div>


