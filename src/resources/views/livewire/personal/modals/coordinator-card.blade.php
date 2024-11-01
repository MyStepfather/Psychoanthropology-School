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

        <div class="mod-header-coordinator">
            <div class="title_fz23_mob">
                {{ $coordinator?->name_first }} {{ $coordinator?->name_last }}
            </div>
            <button type="button" class="close cross-coordinator">
                <img src="./img/icons/cross.svg">
            </button>
        </div>
        @if($coordinator && $members)
            <div class="font-w" style="display: flex; flex-direction: row; gap: 10px; align-items: center; margin-top: 20px;">
                <img src="img/icons/Coins.svg" alt="">
                Взносы
            </div>
            <div class="group-tools__date-select" style="margin-left: 0 !important;">
                <select class="title_fz15_mob" name="group-tools__year"
                        id="group-tools__year" wire:model="selectedYear" wire:change="updateMonthlySubscribe">
                    <option value="{{ date('Y') }}" > {{ date('Y') }} </option>
                    <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                    <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                </select>
                <div class="title_fz15_mob d-flex gap-4">
                    <img role="button"
                        wire:click = "decreaseMonth"
                        src="./img/icons/arrow_left_big.svg" alt="">
                    {{ \Carbon\Carbon::createFromDate(null, $selectedMonth, 1)->locale('ru')->isoFormat('MMMM') }}                <img role="button"
                        wire:click = "increaseMonth"
                        src="./img/icons/arrow_right_big.svg" alt="">
                </div>
            </div>

            {{--                Список пользователей--}}
            <div class="modal-inner">
                <ol class="participants-list w-100-per">
                    @foreach($members as $member)
                        <li
                            class="participants-list__item"
                            wire:key="{{ $loop->index . rand(0, 1000000) }}"
                        >
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="text_fz15_mob" role="button"
                                data-bs-target="#coordinator_card"
                                data-id-coordinator="{{ $member->id }}">
                                    {{ $member->name_last}} {{$member->name_first}}
                                </p>

                                @if($member->unpaidMonthsCount)
                                    <p class="participants-list__notification
                                        participants-list__notification--active">
                                        {{ $member->unpaidMonthsCount }}
                                    </p>
                                @endif

                                <div class="d-flex justify-content-end flex-grow-1">
                                    <p class="participants-list__status @if($member->is_subscribe) participants-list__status--active @endif">
                                    </p>
                                </div>

                                {{--                        <livewire:personal.coordinator.user-status-toggler--}}
                                {{--                            :wire:key="$member->id"--}}
                                {{--                            :userId="$member->id"--}}
                                {{--                        />--}}

                                {{--                        <p wire:click="toggleUserStatus({{ $member->id }})"--}}
                                {{--                           class="btn-toggle @if($member->is_active) btn-toggle--active @endif">--}}
                                {{--                        </p>--}}
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif
     @endif

    </div>
