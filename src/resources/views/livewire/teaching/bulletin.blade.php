<div class="my-container-border width-50">
    <div class="padding-wrapper">
        <h1 class="teaching__header title_fz30">Учение</h1> 
        <div class="bulletin menu__teaching__content teaching__tab__content animate__animated animate__fadeIn">
            <h2 class="teaching__title title_fz18_mob">Бюллетень связи</h2>
            <p class="teaching__descr text_fz15_mob mt-10-35">
                Журнал информации и связи со Школой Психоантропологии — Бюллетень связи (прежде Заметки для чтения) переводится на русский с 2010 года, открыт для всех учеников и представляет собой синтез бесед и содержания обучений/стажей ПА в течение месяца.
            </p>

            <!-- Выпадающий список для фильтрации по годам -->
            <div class="bulletins mt-30-35">
                <div class="dropdown dropdown--hide font-w" style="max-width: 200px; position: relative;">
                    <select wire:model="selectedYear" class="dropdown__selected dropdown__selected--no-bg">
                        <option value="">Все годы</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Список бюллетеней -->
            <div class="bulletin__list mt-20">
                @if($bulletins->isEmpty())
                    <p>Материалы еще не добавлены</p>
                @else
                    @foreach($bulletins as $bulletin)
                        <a href="#" wire:click.prevent="showBulletinDetails({{ $bulletin->id }})">
                            № {{$bulletin->number}} {{ \Carbon\Carbon::parse($bulletin->date)->locale('ru')->isoFormat('MMMM') }}
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="song-details-container">
    <livewire:teaching.song-item :id="$currentBulletinId" :type="'bulletin'" />
</div>
