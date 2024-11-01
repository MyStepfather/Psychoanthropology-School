<div>

{{--                Для блока Взносы--}}
    <div class="group-tools__date-select ">
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
            {{ \Carbon\Carbon::createFromDate(null, $selectedMonth, 1)->locale('ru')->isoFormat('MMMM') }}
            <img role="button"
                 wire:click = "increaseMonth"
                 src="./img/icons/arrow_right_big.svg" alt="">
        </div>

    </div>

{{--                Список пользователей--}}
    <div class="modal-inner">
        <ol class="participants-list w-100-per">
            @foreach($users as $user)
                <li
                    class="participants-list__item"
                    wire:key="{{ $loop->index . rand(0, 1000000) }}"
                >
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="text_fz15_mob" role="button"
                            wire:click="$emitUp('userSelected', {{ $user->id }})"
                            data-bs-target="#student_card"
                           data-id-student="{{ $user->id }}">
                            {{ $user->name_last}} {{$user->name_first}}
                        </p>

                        @if($user->unpaidMonthsCount)
                            <p class="participants-list__notification
                                participants-list__notification--active">
                                {{ $user->unpaidMonthsCount }}
                            </p>
                        @endif

                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="participants-list__status @if($user->is_subscribe) participants-list__status--active @endif">
                            </p>
                        </div>

                        <livewire:personal.coordinator.user-status-toggler
                            :wire:key="$user->id"
                            :userId="$user->id"
                        />

                       {{-- <p wire:click="toggleUserStatus({{ $user->id }})"
                          class="btn-toggle @if($user->is_active) btn-toggle--active @endif">
                       </p> --}}
                    </div>
                </li>
            @endforeach

        </ol>
    </div>
</div>

