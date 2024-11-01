    <div x-data="{ open: @entangle('visible'), closing: false }" 
    x-init="$watch('open', value => { 
        if (!value) { 
            closing = true; 
            setTimeout(() => { closing = false; }, 10); 
        } 
    })"
    :class="{ 'open': open && !closing, 'closing': closing }" 
    @click.away="if(open) { open = false }" 
        class="stans-songs-details-container stans-songs-details-content">
        
        @if($visible) 
            <div class="mod-header-student">
                <img class="me-2 student-ico" src="{{ $user?->avatar ? asset($user->avatar) : asset('img/navbar/logo.svg') }}" alt="Личная">
                <button type="button" class="close cross-student" wire:click.prevent="hide" @click.prevent="closing = true;">
                    <img src="/img/icons/cross.svg">
                </button>
            </div>
            <div class="mod-body-student">
                @if($user)
                    <div class="title_fz23_mob">
                        {{ $user->name_first }} <br>  {{ $user->name_last }}
                    </div>
                    <div class="text_15-12">
                        <div>
                            @php
                                $country = optional($user->group?->town?->country)->name
                                ?? optional($user->group?->country)->name;
                            @endphp
                            {{ $country ?? 'Не указано' }},
                            {{ optional($user->group?->town)->name ?? 'Город не указан' }}
                        </div>

                        @if($user->councils->count())
                            @foreach($user->councils as $council)
                                <div>
                                    Член Совета региона {{ $council->name }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="student-info text_fz15_mob ">
                        <div class="title_fz15_mob">
                            Группа: {{ $user->group?->coordinator->name ?? 'Координатор не указан' }}
                        </div>
                        @if($user->coordinators->count())
                            <div>
                                Координатор
                            </div>
                        @endif
                        @if($user->helpers->count())
                            <div>
                                Помощник координатора
                            </div>
                        @endif
                        <div class="">
                            В Школе с
                            {{ \Carbon\Carbon::parse($user->entered_at)->locale('ru')->isoFormat('LL') }}
                        </div>
                    </div>
                    <div class="student-contacts text_fz15_mob">
                        <div class="title_fz18">
                            Контакты
                        </div>
                        <div class="text_fz15_mob">
                            @if($user->phone)
                                Телефон: <a href="tel: {{ $user->phone }}">{{ $user->phone }}</a> <br>
                            @endif
                            @if($user->email)
                                Эл. почта: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a> <br>
                            @endif
                            @if($user->telegram )
                                Телеграм: <a href="tg://resolve?domain={{ $user->telegram }}">{{ $user->telegram }}</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
