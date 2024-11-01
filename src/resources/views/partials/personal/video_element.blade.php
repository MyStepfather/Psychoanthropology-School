@foreach ($myVideo as $video)
    <div class="collections-card no-border"> <!-- карточка сборника -->
        <a href="">
            <img class="collections-card__img" src="{{ asset($video->cover) }}" alt="">
            <h2 class="collections-card__title title_fz15">
                {{ $video->name }}
            </h2>
            @if ($video->description)
                <p class="collections-card__descr title_fz12">
                    {!! $video->description !!}
                </p>
            @endif
        </a>
    </div>
@endforeach
