<div x-data="{ open: @entangle('visible'), closing: false }" 
    x-init="$watch('open', value => { 
        if (!value) { 
            closing = true; 
            setTimeout(() => { closing = false; }, 10); 
        } 
    })"
    :class="{ 'open': open && !closing, 'closing': closing }" 
    @click.away="if(open) { open = false }" 
    class="stans-songs-details-container">
    @if($visible)
        <div id="media-details" class="stans-songs-details-content">
            @if($item && ($itemTexts->isNotEmpty() || $itemLanguages->isNotEmpty() || $itemResources->isNotEmpty()))
                <div class="position-relative">
                    @if($mediaType === 'task' || $mediaType === 'bulletin')
                        <div class="text_fz15_mob my-3">
                            {{ \Carbon\Carbon::parse($itemTexts->first()->date)->locale('ru')->translatedFormat('F Y') }}
                        </div>
                        <h1 class="teaching-song-h1 my-3 title_fz18_mob">
                            {{ $itemTexts->first()->title }}
                        </h1>
                    @else
                        <h1 class="teaching-song-h1 my-3 title_fz18_mob">
                            {{ $item->name }}
                        </h1>
                    @endif

                    @if($mediaType === 'task' || $mediaType === 'bulletin')
                        <div class="item-song-tab__content show">
                            <div class="text_fz15_mob my-3">{!! $itemTexts->first()->text !!}</div>
                            @if($mediaType === 'bulletin' && isset($itemTexts->first()->url))
                                <div class="mt-10-35">
                                    <a href="{{ asset($itemTexts->first()->url) }}" download>
                                        <button class="archive__list__btn">Скачать</button>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @elseif (!$itemLanguages->isEmpty())
                        <ul class="item-song__tabs">
                            @foreach($itemLanguages as $i => $language)
                                <li class="tab__btn item-song__tab @if($language->id === $activeLanguageId) item-song__tab-active @endif"
                                    wire:click.prevent="setActiveLanguage({{ $language->id }})">
                                    {{ $language['name'] }}
                                </li>
                            @endforeach
                        </ul>

                        @foreach ($itemLanguages as $language)
                            <div class="item-song-tab__content collapse @if($language->id === $activeLanguageId) show @endif">
                                @foreach ($itemTexts as $text)
                                    @if ($text['language_id'] === $language['id'])
                                        <div class="title_fz18_mob mt-3">{{ $text['title'] }}</div>
                                        <div class="text_fz15_mob my-3">{!! $text['text'] !!}</div>
                                    @endif
                                @endforeach
                                @foreach ($itemResources as $resource)
                                    @if ($resource['language_id'] === $language['id'])
                                        <div class="teaching-wrap-song mb-3">
                                            @foreach ($itemArtists as $artist)
                                                @if ($artist['id'] === $resource['artist_id'])
                                                    <div class="teaching-title-song-listen title_fz15_mob">{{ $artist['name'] }}</div>
                                                @endif
                                            @endforeach
                                            <a class="teaching-btn-song-listen btn_white text-center" target="_blank" href="{{ asset($resource['url']) }}">
                                                <img src="{{ asset('img/icons/arrow_right.svg') }}" alt="Просмотреть">
                                            </a>
                                            <a href="{{ asset($resource['url']) }}" download>
                                                <img src="{{ asset('img/icons/download.svg') }}" alt="download">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endif

                    <!-- Кнопка для скрытия блока -->
                    <a class="position-absolute top-0 end-0" href="#" wire:click.prevent="hide" @click.prevent="closing = true;">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="5.99504" y1="23.7004" x2="23.7921" y2="5.90327" stroke="#102F39" stroke-width="2"/>
                            <line x1="6.40242" y1="5.90324" x2="24.1995" y2="23.7003" stroke="#102F39" stroke-width="2"/>
                        </svg>
                    </a>
                </div>
            @else
                <div class="text-center text_fz15_mob mt-5">Материалы еще не добавлены</div>
            @endif
        </div>
    @endif
</div>


