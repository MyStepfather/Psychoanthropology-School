<div class="position-relative w-100">
    <div class="login__create-btn login__btn btn_dark btn_dark_width mt-25-20 mw-195 title_fz12 font-w text-center" style="opacity:@if($isUploaded) 0.5 @else 1 @endif">
        @if ($isUploaded) Загрузить другую фотографию @else Загрузить фотографию@endif
    </div>
    <input wire:model="photo" type="file" accept="image/jpeg, image/png" name="photo" class="position-absolute w-100 h-75" style="top: 20%;z-index: 1;opacity: 0;cursor: pointer">
    @if ($isUploaded)
        <div id="photoUploaded" class="mt-15">Фотография загружена</div>
    @endif
</div>