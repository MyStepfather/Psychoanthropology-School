<div>
    <div class="reg__checkbox login__checkbox">
        <input name="agree_contact" type="checkbox" class="checkbox__box" wire:model="checkbox1" >
        <p class="text_fz12_mob">согласен(на), чтобы мои контактные данные отображались на сайте для личной связи с другими учениками. Со стороны Школы ваши данные никогда не будут использоваться для отправки сообщений не относящихся к учению Психоантропологии.  (во избежании спама эл. почта не публикуется на сайте)</p>
    </div>
    <div class="reg__checkbox login__checkbox">
        <input name="agree_policy" type="checkbox" class="checkbox__box" wire:model="checkbox2" >
        <p class="text_fz12_mob">нажимая на кнопку, я даю свое согласие на обработку персональных данных и соглашаюсь с условиями политики конфиденциальности.</p>
    </div>
    <div class="reg__btns gap-30">
        <button type="submit" class="reg__btn login__btn btn_dark btn_dark_width btn-registration" @if(!$checkbox1 || !$checkbox2) disabled @endif>Зарегистрироваться</button>
        <button class="reg__back-btn"><a href="{{ route('show.step3') }}">Назад</a></button>
    </div>
</div>
