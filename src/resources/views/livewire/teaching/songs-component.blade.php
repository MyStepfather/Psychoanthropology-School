<div>
    <h3 class="stans-songs__title title_fz18">Песни</h3>
    
    @if($songs->isEmpty())
        <p>Материалы еще не добавлены</p>
    @else
        <!-- Слайдер песен -->
        <div class="stans-songs__slider teaching__slider">
            <a wire:click="previousPage" wire:loading.attr="disabled" href="#" wire:loading.class="disabled" @if($songs->firstItem() <= 1) style="pointer-events: none" @endif>
                <img src="{{ asset('/img/icons/Arrow-left.svg') }}" alt="">
            </a>
            <div class="teaching__slider__content title_fz15_mob">
                {{ $songs->firstItem() }}-{{ $songs->lastItem() }} из {{ $songs->total() }}
            </div>
            <a wire:click="nextPage" wire:loading.attr="disabled" href="#" wire:loading.class="disabled" @if($songs->lastItem() >= $songs->total()) style="pointer-events: none" @endif>
                <img src="{{ asset('/img/icons/Arrow-right.svg') }}" alt="">
            </a>
        </div>

        <!-- Список песен -->
        <ol start="{{ $songs->firstItem() }}" class="stans-songs__stans-list title_fz15_mob">
            @foreach($songs as $item)
                <li>
                    <a href="#" wire:click.prevent="showSongDetails({{ $item->id }})">{{ $item->name }}</a>
                </li>
            @endforeach
        </ol>

        <!-- Отображение компонента с информацией о песне -->
        <div class="song-details-container">
            <livewire:teaching.song-item :id="$currentSongId" :type="'song'" />
        </div>
    @endif
</div>
