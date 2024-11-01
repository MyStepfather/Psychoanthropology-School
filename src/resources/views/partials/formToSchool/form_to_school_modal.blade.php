<div class="modal fade modal-lg" id="form_to_school_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content custom_modal br-15">
            <div class="modal-header d-flex justify-content-between mt-2 pb-0 ">
                <h2 class="title_fz23_mob">
                    Написать в Школу
                </h2>
                <button type="button" class="close accordion-button--justify-position" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('img/icons/close_modal.svg') }}" aria-hidden="true">
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="form_to_school box_content mb-5 pt-0">
                    <div class="collaps_head">

                        <div class="text_fz15_mob mt-3">
                            Если у вас есть вопрос, который вы не можете решить с координатором или друзьями на Пути, напишите его в Школу, мы поможем его разрешить.
                        </div>
                        <label for="topic_form_main" class="mb-2 mt-4 title_fz15_mob">Тема</label>
                        <select id="topic_form_main" class="form-select form_choose_topic" aria-label="Пример выбора по умолчанию">
                            <option selected>Выберите пожалуйста тему</option>
                            @foreach($topics as $topic)
                                <option value="{{ $topic }}">{{ $topic }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="collaps_body mt-5">
                        <div class="title_fz15_mob mb-3">Возможно вам помогут эти статьи</div>
                        @foreach($articles as $article)
                            <a href="{{ $article->url }}" class="btn_text">{{ $article->name }}</a> <br>
                        @endforeach
                        <div class="text_fz15_mob mt-4 mb-3">
                            Если среди предложенного нет нужного ответа, заполните пожалуйста форму
                        </div>
                        <input class="input_txt form-control mb-3 form_custom_topic" type="text" placeholder="Тема" aria-label="пример ввода по умолчанию">
                        <select id="topic_form_main" class="form-select form_to_whom" aria-label="Пример выбора по умолчанию" aria-placeholder="Кому">
                            <option selected>Кому</option>
                            @foreach($representatives as $representative)
                                <option value="{{ $representative }}">{{ $representative }}</option>
                            @endforeach
                        </select>
                        <label for="message_form_main" class="mb-2 mt-4 title_fz15_mob">Сообщение</label>
                        <textarea id="message_form_main" class="area_txt form-control mt-2 form_message" id="exampleFormControlTextarea1" rows="6"></textarea>
                        <div class="btn_dark form-btn">Отправить</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
