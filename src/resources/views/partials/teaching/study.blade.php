<div class="my-container-border">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="study teaching__tab__content menu__teaching__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Обучение и стажи</h2>
            <p class="teaching__descr text_fz15_mob mt-10-35">Обучения и стажи являются неотъемлемой частью передачи и интеграции Учения. Обучения проходят ежемесячно, кроме месяцев, когда есть стаж.</p>
            <p class="teaching__descr text_fz15_mob">Обучения открыты для всех учеников Школы.</p>
            <p class="teaching__descr teaching__descr_br text_fz15_mob mt-30-35">Расписание обучений и стажей</p>
            <div class="study__condition">
                <h3 class="study__title title_fz18 mt-30-35">Условия участия в стажах</h3>
                <ul class="study__list">
                    <li>Быть учеником группы 5 Пути или учеником группы чтения и состоять в Школе более 6 месяцев.</li>
                    <li>Отправить дуновную биографию на французском, английском или немецком на почту epa.ecole@orange.fr</li>
                    <li>Изучить ответы Селима Айсселя на вопросы китайских учеников по WeChat и ответить на вопросник (ссылка ниже).</li>
                    <li>Посмотреть "Семинар молодых" и ответить на вопросник (ссылка ниже), если это не было сделано раньше.</li>
                </ul>
            </div>
            <p class="my-container-border my-container-border_in-page">Просим соблюдать вышеизложенные правила, проявляя тем самым уважение и благодарность к Трем Столпам.</p>
            <div class="study__links mt-30-35">
                @foreach($entry_docs as $entry_doc)
                    <div class="study__wrapper">
                        <div class="study__links-name title_fz15_mob">{{$entry_doc['name']}}</div>
                        <a href="{{ asset($entry_doc->url) }}" download>
                            <img src="{{asset('/img/icons/download.svg')}}" alt="download">
                        </a>
                    </div>
                @endforeach
                <div class="study__wrapper">
                    <div class="study__links-name title_fz15_mob">Видео «Семинара молодых»</div>
                    <button class="btn_dark study__btn">Купить</button>
                </div>
            </div>
            <h2 id="archive" class="study__video mt-30-35 title_fz18_mob">Видео обучений и стажей</h2>
            <p class="study__video__descr text_fz15_mob">Приобрести видео обучений и стажей вы можете в разделе
                <span><a href="{{ route('shop.teaching.show') }}">Магазин</a></span>.
            </p>
        </div>
    </div>    
</div>
