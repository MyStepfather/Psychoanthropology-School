<div class="modal fade modal-lg" id="exercise-actual" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content custom_modal  mt-5">
            <div class="modal-header d-flex justify-content-between mt-2 pb-0 ">
                <h2 class="title_fz23_mob">
                    Актуальное упражнение
                </h2>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="box_content mb-5 pt-0">
                    <div class="position-relative">
                        <p class="text_fz15_mob mt-20">{{ $exercise['month'] }}</p>
                        <h2 class="teaching__title title_fz18_mob">{{ $exercise['title'] }}</h2>
                        <p class="teaching__descr text_fz15_mob mt-20">{!! $exercise['text'] !!}</p>
                    </div>
                    <button class="header__nav-btn btn_white title_fz12_mob"  type="button" data-bs-dismiss="modal" aria-label="Close">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>
