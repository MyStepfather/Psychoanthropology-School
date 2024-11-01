<div>
    <h3 class="stans-songs__title title_fz18">Стансы</h3>
    <p class="stans-songs__descr text_fz15_mob">Музыкальные файлы всех версий стансов</p>
    
    <!-- Проверка наличия стансов -->
    @if($stans->isEmpty())
        <p>Материалы еще не добавлены</p>
    @else
        <!-- Слайдер стансов -->
        <div class="stans-songs__slider teaching__slider">
            <a wire:click="previousPage" wire:loading.attr="disabled" href="#" wire:loading.class="disabled" @if($stans->firstItem() <= 1) style="pointer-events: none" @endif>
                <img src="{{ asset('/img/icons/Arrow-left.svg') }}" alt="">
            </a>
            <div class="teaching__slider__content title_fz15_mob">
                {{ $stans->firstItem() }}-{{ $stans->lastItem() }} из {{ $stans->total() }}
            </div>
            <a wire:click="nextPage" wire:loading.attr="disabled" href="#" wire:loading.class="disabled" @if($stans->lastItem() >= $stans->total()) style="pointer-events: none" @endif>
                <img src="{{ asset('/img/icons/Arrow-right.svg') }}" alt="">
            </a>
        </div>

        <!-- Список стансов -->
        <ol start="{{ $stans->firstItem() }}" class="stans-songs__stans-list title_fz15_mob">
            @foreach($stans as $stan)
                <li>
                    <a href="#" wire:click.prevent="showStansDetails({{ $stan->id }})">{{ $stan->name }}</a>
                </li>
            @endforeach
        </ol>
    @endif

    <!-- Отображение компонента с информацией о стансе -->
    <div class="stans-details-container">
        @if($currentStansId)
            <livewire:teaching.song-item :id="$currentStansId" :type="'stans'" />
        @endif
    </div>
</div>
