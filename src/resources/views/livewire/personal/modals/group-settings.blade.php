<div>
    <div x-data="{ open: @entangle('visible'), closing: false }" 
        x-init="$watch('open', value => { 
            if (!value) { 
                closing = true; 
                setTimeout(() => { closing = false; }, 10); 
            } 
        })"
        :class="{ 'open': open && !closing, 'closing': closing }" 
        @click.away="if(open) { open = false }" 
        class="stans-songs-details-container stans-songs-details-container-fix stans-songs-details-content">
    
        @if($visible) 

            <div class="modal-header-settings">
                <h2 class="title_fz23_mob">Настройки группы</h2>
                <button type="button" class="close-settings-modal" wire:click.prevent="hide" @click.prevent="closing = true;">
                    <span><img src="./img/icons/cross.svg"></img></span>
                </button>
            </div>
            
            <div class="modal-body-settings">
                <div class="mod-settings-body-item">
                    <label class="mb-2 title_fz15_mob" for="">Тип</label>
                    <div class="dropdown-disable">
                        @if($group)
                            <div class="dropdown__selected">{{ \App\Constants\GroupTypes::ALL_NAMES[$group->type] ?? 'Тип не указан' }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="mod-settings-body-item">
                    <label class="mb-2 title_fz15_mob" for="">Страна</label>
                    <div class="dropdown-disable">
                        @php
                            $country = $group?->town?->country->name ?? $group?->country?->name ?? 'Страна не указана';
                        @endphp
                        <div class="dropdown__selected">{{ $country }}</div>
                    </div>
                </div>
                
                <div class="mod-settings-body-item">
                    <label class="mb-2 title_fz15_mob" for="">Город</label>
                    <div class="dropdown-disable">
                        <div class="dropdown__selected">{{ $group?->town?->name ?? 'Город не указан' }}</div>
                    </div>
                </div>
                
                <div class="mod-settings-body-item">
                    <label class="mb-2 title_fz15_mob" for="">Регион</label>
                    <div class="dropdown-disable">
                        @php
                            $council = $group?->town?->council->name ?? $group?->country?->council?->name ?? 'Регион не указан';
                        @endphp
                        <div class="dropdown__selected">{{ $council }}</div>
                    </div>
                </div>

                <div class="mod-settings-body-item">
                    <label class="mb-2 title_fz15_mob" for="">Дата и время проведения:</label>
                    <div class="users-date__date-lists users-date__date-lists-gap" id="topic_form_main">
                        <div class="dropdown-for-livewire dropdown" style="width: 50%;">
                            @php
                                $dayName = \Illuminate\Support\Str::ucfirst(\Carbon\Carbon::now()->startOfWeek()->addDays($selectedDay - 1)->locale('ru')->isoFormat('dddd'));
                            @endphp
                            <div class="dropdown__selected">{{ $dayName ?? 'День не указан' }}</div>
                            <div class="dropdown__list">
                                <div class="dropdown__item" data-day="1">Понедельник</div>
                                <div class="dropdown__item" data-day="2">Вторник</div>
                                <div class="dropdown__item" data-day="3">Среда</div>
                                <div class="dropdown__item" data-day="4">Четверг</div>
                                <div class="dropdown__item" data-day="5">Пятница</div>
                                <div class="dropdown__item" data-day="6">Суббота</div>
                                <div class="dropdown__item" data-day="7">Воскресенье</div>
                            </div>
                        </div>
                        <div class="users-date__date-lists">
                            <input wire:model="hour" class="form-select form-select_time display-flex-center"/>
                            <span class="fw-bold users-data__list_no-width pt-2 display-flex-center">:</span>
                            <input wire:model="minutes" class="form-select form-select_time display-flex-center"/>
                        </div>
                    </div>
                </div>
                
                <div class="mod-settings-body-item">
                    <label for="message_form_main" class="mb-2 title_fz15_mob">Место проведения</label>
                    <textarea wire:model="place" class="mod-text-area" id="exampleFormControlTextarea1" rows="2">{{ $place ?? 'Место не указано' }}</textarea>
                </div>

                {{-- Первый помощник --}}
                @if($helper1)
                    <div class="mod-settings-body-item">
                        <label class="mb-2 title_fz15_mob" for="">Помощник координатора</label>
                        <div class="dropdown-for-livewire dropdown">
                            <div class="dropdown__selected">
                                @php
                                    $helpername1 = $helper1?->name_last . ' ' . $helper1?->name_first ?? 'Помощник не указан';
                                @endphp
                                {{ $helpername1 }}
                            </div>
                            <div class="dropdown__list">
                                @if($group?->users)
                                    @foreach($group?->users as $user)
                                        <div class="dropdown__item" data-id-helper1="{{$user->id}}">
                                            {{ $user->name }}
                                            Других помощников нет
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Второй помощник --}}
                @if($helper2)
                    <div class="mod-settings-body-item">
                        <label class="mb-2 title_fz15_mob" for="">Помощник координатора</label>
                        <div class="dropdown">
                            <div class="dropdown__selected">
                                @php
                                    $helpername2 = $helper2?->name_last . ' ' . $helper2?->name_first ?? 'Помощник не указан';
                                @endphp
                                {{ $helpername2 }}
                            </div>
                            <div class="dropdown__list">
                                @if($group?->users)
                                    @foreach($group?->users as $user)
                                        <div class="dropdown__item" data-id-helper2="{{$user->id}}">
                                            {{ $user->name }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="">
                    <button wire:click="updateGroup" class="btn_dark btn_dark_modal mt-2" style="max-width: 314px;">
                        Сохранить изменения
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

