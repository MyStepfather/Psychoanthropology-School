<div class="position-relative">
    <h1 class="teaching-song-h1 my-3 title_fz18_mob">{{ $song->name }}</h1>
    <ul class="item-song__tabs">
        @if(!$songLanguages->isEmpty())
            @foreach($songLanguages as $i => $item)
                <li class="tab__btn item-song__tab @if($i === 0) item-song__tab-active @endif">{{ $item['name'] }}</li>
            @endforeach
        @endif
    </ul>
    @if (!$songLanguages->isEmpty())
        @foreach ($songLanguages as $i => $item)
            <div class="item-song-tab__content collapse @if($i === 0) show @endif">
                @foreach ($songTexts as $text)
                    @if ($text['language_id'] === $item['id'])
                        <div class="title_fz18_mob mt-3">{{ $text['title'] }}</div>
                        <div class="text_fz15_mob my-3">{!! $text['text'] !!}</div>
                    @endif
                @endforeach
                @foreach ($songResources as $resource)
                    @if ($resource['language_id'] === $item['id'])
                        <div class="teaching-wrap-song mb-3">
                            @foreach ($songArtists as $artist)
                                @if ($artist['id'] === $resource['artist_id'])
                                    <div class="teaching-title-song-listen title_fz15_mob">{{ $artist['name'] }}</div>
                                @endif
                            @endforeach
                            <a class="teaching-btn-song-listen btn_white text-center" target="_blank" href="{{ asset($resource['url']) }}">
                                <img src="{{ asset('img/icons/arrow_right.svg') }}" alt="Слушать">
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
    <a class="position-absolute top-0 end-0" href="{{ route('teaching.songs') }}">
        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line x1="5.99504" y1="23.7004" x2="23.7921" y2="5.90327" stroke="#102F39" stroke-width="2"/>
            <line x1="6.40242" y1="5.90324" x2="24.1995" y2="23.7003" stroke="#102F39" stroke-width="2"/>
        </svg>
    </a>
</div>






