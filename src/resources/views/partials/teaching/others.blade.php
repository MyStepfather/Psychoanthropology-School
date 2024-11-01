<div class="my-container-border">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="others menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Статьи, тексты и другие материалы</h2>
            <div class="others__links">
                @foreach($articles as $article)
                    <a href="{{ route('teaching.others.item', ['id' => $article->id]) }}" class="title_fz15_mob">
                        {{$article->name}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>    
</div>
