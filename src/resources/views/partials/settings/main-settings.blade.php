@php
    $user = auth()->user();
    $birthday = $user->birthdate;
@endphp

<div class="users-data">
    <div class="my-settings__header-wrapper">
        <img src={{ asset('img/icons/Arrow-left.svg') }} alt="" class="my-settings__back">
        <div class="my-settings__title title_fz23_mob">Личные данные</div>
    </div>
    <form class="users-data__wrapper" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="users-data__input-wrapper users-name">
            <label for="name" class="users-data__label users-name__name">Имя</label>
            <input type="text" id="name" name="name_first" placeholder="{{ $user->name_first }}"
                class="users-data__input users-name__place">
        </div>
        <div class="users-data__input-wrapper users-name">
            <label for="surname" class="users-data__label users-name__name">Фамилия</label>
            <input type="text" id="surname" name="name_last" placeholder="{{ $user->name_last }}"
                class="users-data__input users-name__place">
        </div>
        <div class="users-photo">
            <div class="users-photo__wrapper">
                <img id="user-avatar" class="me-2 menu_photo users-photo__curent"
                    @if ($user->avatar) src="{{ Storage::url($user->avatar) }}"
                @else src="{{ asset('img/navbar/logo.svg') }}" @endif
                    alt="Школа ПА">
            </div>
            <div class="users-photo__settings">
                <div class="title_fz18">Фотография</div>
                <div class="users-photo__btns-wrapper">
                    <div class="position-relative" style="">
                        <button class="btn_white users-photo__white-btn">Изменить</button>
                        <input onchange="displaySelectedImage(this)" type="file" accept="image/jpeg, image/png"
                            name="file" class="position-absolute w-100 h-100"
                            style="left: 0;z-index: 1;opacity: 0;cursor: pointer">
                    </div>
                    <button id="delete-avatar" class="btn_red users-photo__red-btn">Удалить</button>
                </div>
            </div>
        </div>
        <div class="users-date">
            <div class="users-date__date-wrapper">
                <label for="birthdate" class="users-data__label">Дата рождения:</label>
                <div class="users-date-member-wrapper">
                    <div class="dropdown dropdown--day">
                        <div class="dropdown__selected">{{ date('d', strtotime($user->birthdate)) }}</div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">01</div>
                            <div class="dropdown__item">02</div>
                            <div class="dropdown__item">03</div>
                            <div class="dropdown__item">04</div>
                            <div class="dropdown__item">05</div>
                            <div class="dropdown__item">06</div>
                            <div class="dropdown__item">07</div>
                            <div class="dropdown__item">08</div>
                            <div class="dropdown__item">09</div>
                            <div class="dropdown__item">10</div>
                            <div class="dropdown__item">11</div>
                            <div class="dropdown__item">12</div>
                            <div class="dropdown__item">13</div>
                            <div class="dropdown__item">14</div>
                            <div class="dropdown__item">15</div>
                            <div class="dropdown__item">16</div>
                            <div class="dropdown__item">17</div>
                            <div class="dropdown__item">18</div>
                            <div class="dropdown__item">19</div>
                            <div class="dropdown__item">20</div>
                            <div class="dropdown__item">21</div>
                            <div class="dropdown__item">22</div>
                            <div class="dropdown__item">23</div>
                            <div class="dropdown__item">24</div>
                            <div class="dropdown__item">25</div>
                            <div class="dropdown__item">26</div>
                            <div class="dropdown__item">27</div>
                            <div class="dropdown__item">28</div>
                            <div class="dropdown__item">29</div>
                            <div class="dropdown__item">30</div>
                            <div class="dropdown__item">31</div>
                        </div>
                        <input name="birthday_day" type="hidden" value="{{date('d', strtotime($user->birthdate))}}">
                    </div>
                    <div class="dropdown">
                        <div class="dropdown__selected">
                            {{ \Carbon\Carbon::parse($user->birthdate)->locale('ru')->isoFormat('MMMM') }}</div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">сентябрь</div>
                            <div class="dropdown__item">октябрь</div>
                            <div class="dropdown__item">ноябрь</div>
                            <div class="dropdown__item">декабрь</div>
                            <div class="dropdown__item">январь</div>
                            <div class="dropdown__item">февраль</div>
                            <div class="dropdown__item">март</div>
                            <div class="dropdown__item">апрель</div>
                            <div class="dropdown__item">май</div>
                            <div class="dropdown__item">июнь</div>
                            <div class="dropdown__item">июль</div>
                            <div class="dropdown__item">август</div>
                        </div>
                        <input name="birthday_month" type="hidden" value="{{date('m', strtotime($user->birthdate))}}">
                    </div>
                    <div class="dropdown">
                        <div class="dropdown__selected">{{ date('Y', strtotime($user->birthdate)) }}</div>
                        <div class="dropdown__list">
                            @php
                                $options = '';
                                for ($i = 1960; $i <= date('Y'); $i++) {
                                    $options .= '<div class="dropdown__item">' . $i . '</div>';
                                }
                            @endphp

                            {!! $options !!}
                        </div>
                        <input name="birthday_year" type="hidden" value="{{date('Y', strtotime($user->birthdate))}}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="users-data__btn btn_dark btn_dark_width">Сохранить</button>
    </form>
    @if($errors->any())
        <div class="mt-4 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="mt-4 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</div>
<script>
    function displaySelectedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('user-avatar').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.getElementById('delete-avatar').addEventListener('click', function(event) {
        event.preventDefault(); // Предотвращаем стандартное действие кнопки

        // Отправляем запрос на удаление аватарки
        fetch('{{ route('deleteAvatar') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Если операция удаления успешна, обновляем изображение на иконку по умолчанию
                    document.getElementById('user-avatar').src = '{{ asset('img/navbar/logo.svg') }}';
                } else {
                    // Обработка ошибки удаления, если необходимо
                    alert('Ошибка при удалении аватарки.');
                }
            })
            .catch(error => {
                console.error('Ошибка: ', error);
                alert('Ошибка при отправке запроса.');
            });
    });
</script>
