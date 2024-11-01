<div class="my-container-border width-50">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1>
        <div class="exercises menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Упражнения</h2>
            <ul class="exercises__tabs mt-10-35">
                <li class="tab__btn exercises__tab exercises__tab-active ">
                    <div class="font-w">Актуальные</div>
                </li>
                <li class="tab__btn exercises__tab">
                    <div class="font-w">Ежедневные</div>
                </li>
            </ul>
            <div class="exercises__tab__content collapse show">
                <p class="teaching__descr text_fz15_mob mt-20">Все упражнения могут быть использованы как напоминания, чтобы
                    выйти из механистичных обыденных реакций. Когда происходит какая-либо ситуация, то для того, чтобы выйти из
                    неё, мы используем одно из упражнений. Актуальное упражнение — приоритетная линия работы учеников Школы.</p>
                <p class="text_fz15_mob mt-40">Актуальное упражнение - приоритетная линия работы учеников Школы.</p>
                @livewire('teaching.task')
            </div>

            <div class="exercises__tab__content collapse">
                <p class="text_fz15_mob mt-20">Упражнение дается каждый день после утренней беседы.</p>
                @livewire('teaching.date-component')
            </div>
        </div>
    </div>    
</div>