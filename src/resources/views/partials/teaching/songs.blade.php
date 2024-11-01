<div class="my-container-border width-50">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="stans-songs menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Стансы и песни</h2>
            <p class="teaching__descr text_fz15_mob mt-10-35">В этом разделе представлены песни Учения и стансы. Вы найдёте музыкальные файлы, слова на русском и французском языках с транскрипцией.</p>
            <ul class="stans-songs__tabs">
                <li class="tab__btn stans-songs__tab stans-songs__tab-active"><div class="font-w">Стансы</div></li>
                <li class="tab__btn stans-songs__tab"><div class="font-w">Песни</div></li>
            </ul>
            <div class="stans-songs__tab__content collapse show">
                @livewire('teaching.stans-component')
            </div>
            <div class="stans-songs__tab__content collapse">
                @livewire('teaching.songs-component')
            </div>
        </div>
    </div>    
</div>

