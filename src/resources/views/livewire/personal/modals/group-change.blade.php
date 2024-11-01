<div>
    <div class="mod-header-changes">
        <h2 class="title_fz23" style="max-width: 286px;">
            Сообщить об изменениях в группе
        </h2>
        <button type="button" class="close cross-changes" data-bs-dismiss="modal"
                aria-label="Close">
            <span><img src="./img/icons/cross.svg" aria-hidden="true"></img></span>
        </button>
    </div>
    <div class="mod-body-changes">
        <p class="text_fz12_mob">Опишите ситуацию ученика. Например, переход в другую группу
            (какую?), выход из Школы или что-то другое.</p>
        <label for="message_form_main" class="mb-2 mt-4 title_fz15_mob mt--15">Сообщение</label>
        <textarea
            wire:model="text"
            id="message_form_main"
            class="area_txt mt--15 p-2"
            rows="4">
        </textarea>
        <button
            wire:click="sendChanges"
            type="submit"
            class="btn_dark form-btn login__input"
        >
            Отправить
        </button>
    </div>
</div>
