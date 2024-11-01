<div class="my-container-border">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
            <div class="archive menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
                <h2 class="teaching__title title_fz18_mob">Архивные курсы</h2>
                <p class="archive__descr text_fz15_mob mt-10-35">В архиве собраны все курсы ПА, переведенные на русский язык. Ученику автоматически открывается доступ к курсам, которые были прочитаны им за время нахождения в составе Школы <span>( отмечены <span class="green-ball"></span>  )</span>.</p>
                <p class="teaching__descr text_fz15_mob">Доступ к остальным курсам можно приобрести отдельно — 30 рублей за курс.</p>
                <div class="archive__slider teaching__slider">
                    <a href="#"><img src="assets/img/icons/Arrow-left.svg" alt=""></a>
                    <div class="teaching__slider__content title_fz15_mob">700-750</div>
                    <a href="#"><img src="assets/img/icons/Arrow-right.svg" alt=""></a>
                </div>
                <form action="#">
                    <ul class="archive__list">
                        @foreach($courses as $course)
                            <li><input type="checkbox" class="checkboxes">{{$course['name']}}</li>
                        @endforeach
                        <div class="btn-background">
                            <li id="others"><input class="archive__list__btn" type="submit" value="Оплатить"></li>
                        </div>
                    </ul>
                </form>
            </div>
        </div>    
    </div>
    
