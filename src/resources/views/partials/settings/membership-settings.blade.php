@php
    $user = auth()->user();
@endphp
<div class="users-member">
    <div class="my-settings__header-wrapper">
        <img src="assets/img/icons/Arrow-left.svg" alt="" class="my-settings__back">
        <div class="my-settings__title title_fz23_mob">Членство в Школе</div>
    </div>
    <form method="POST" action="{{ route('changeMembership') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <div class="users-group">
                <div class="dropdown_disabled">
                    <div class="dropdown__selected">{{ $membershipData['selectedCountry'] }}</div>
                    <div class="dropdown__list">

                    </div>
                    <input type="hidden" name="country" id="">
                </div>
                <div class="dropdown_disabled">
                    <div class="dropdown__selected">{{ $membershipData['selectedTown'] }}</div>
                    <div class="dropdown__list">

                    </div>
                    <input type="hidden" name="city" id="">
                </div>
                <div class="dropdown_disabled">
                    <div class="dropdown__selected">{{ $membershipData['selectedCoordinator'] }}</div>
                    <div class="dropdown__list">

                    </div>
                    <input type="hidden" name="coordinator" id="">
                </div>
            </div>
        </div>

        <div class="users-date-member">
            <p class="users-data__label">Дата вступления в Школу</p>
            <div class="users-date-member-wrapper mt-10">
                <div class="dropdown dropdown--day">
                    <div class="dropdown__selected">01</div>
                    <div class="dropdown__list">
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
                    <input type="hidden" name="member_day" id="" value="{{date('d', strtotime($user->entered_at))}}">
                </div>
                <div class="dropdown">
                    <div class="dropdown__selected">{{Carbon\Carbon::parse($user->entered_at)->locale('ru')->isoFormat('MMMM')}}</div>
                    <div class="dropdown__list">
                        <div class="dropdown__item">сентября</div>
                        <div class="dropdown__item">октября</div>
                        <div class="dropdown__item">ноября</div>
                        <div class="dropdown__item">декабря</div>
                        <div class="dropdown__item">января</div>
                        <div class="dropdown__item">февраля</div>
                        <div class="dropdown__item">марта</div>
                        <div class="dropdown__item">апреля</div>
                        <div class="dropdown__item">мая</div>
                        <div class="dropdown__item">июня</div>
                        <div class="dropdown__item">июля</div>
                        <div class="dropdown__item">августа</div>
                    </div>
                    <input type="hidden" name="member_month" value="{{date('m', strtotime($user->entered_at))}}">
                </div>
                <div class="dropdown">
                    <div class="dropdown__selected">{{ date('Y', strtotime($user->entered_at)) }}</div>
                    <div class="dropdown__list">
                        @php
                            $options = '';
                            for ($i = 1960; $i <= date('Y'); $i++) {
                                $options .= '<div class="dropdown__item">' . $i . '</div>';
                            }
                        @endphp
                        {!! $options !!}
                    </div>
                    <input name="member_year" type="hidden" value="{{date('Y', strtotime($user->entered_at))}}">
                </div>
            </div>
        </div>
        <button type="submit" class="users-data__btn btn_dark btn_dark_width">Сохранить</button>
    </form>
</div>
