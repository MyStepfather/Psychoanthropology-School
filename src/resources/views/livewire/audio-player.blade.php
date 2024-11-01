<div>
    <a wire:click="openModal" style="cursor: pointer;">
        <div class="stans_btn_listen btn_white text-center">
            <img src="./img/icons/arrow_right.svg" alt="Слушать">
        </div>
    </a>

    @if($isOpen)
        <div wire:click="closeModal" wire:keydown.escape="closeModal" class="modal show" id="audioModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="audioModalLabel">Мини-плеер</h5>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">

                        <audio controls autoplay>
                            <source src="{{ Storage::url($media->url) }}" type="audio/mp3">
                            Ваш браузер не поддерживает элемент аудио.
                        </audio>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
