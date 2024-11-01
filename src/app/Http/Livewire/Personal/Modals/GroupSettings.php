<?php

namespace App\Http\Livewire\Personal\Modals;

use App\Actions\Notify\GroupSettingsNotifyBuilder;
use App\Models\Group;
use App\Models\User;
use App\Notifications\GroupSettingslNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class GroupSettings extends Component
{
    public $group;

    /**
     * День проведения группы с 1-7, время и место
     * @var
     */
    public $selectedDay;
    public $hour;
    public $minutes;
    public $place;
    public $visible = false; // Изначально компонент скрыт
    public $loading = false; // Логика загрузки данных

    /**
     * Помощники координатора
     * @var
     */
    public $helper1;
    public $helper2;
    public $helper1Old;
    public $helper2Old;

    protected $listeners = ['groupSelected',
                            'daySelected',
                            'helpers1Selected',
                            'helpers2Selected'];

    public function groupSelected($groupId)
    {
        if ($groupId === null) {
            $this->resetUserData();
            return;
        }
            //Получаем текущую группу
            $this->group = Group::with([
                'town' => function ($query) {
                    $query->with('council', 'country');
                },
                'helpers',
                'country.council',
                'users' => function ($query) use ($groupId) {
                    $query->whereGroupId($groupId);
                }
            ])
                ->where('id', $groupId)
                ->first();
            $this->selectedDay = $this->group->weekday;

            // Преобразование времени в объект Carbon
            $timeObject = Carbon::createFromFormat('H:i:s', $this->group->time);
            $this->hour = $timeObject->hour;
            $this->minutes = $timeObject->minute;
            $this->place = $this->group->place;


            if ($this->group?->helpers->count()){
                $this->helper1 =  $this->helper1Old = $this->group?->helpers[0];
            }

            if ($this->group?->helpers->count() > 1 ){
                $this->helper2 = $this->helper2Old =  $this->group?->helpers[1];
            }
                    // Проверка: если пользователь найден, показываем карточку

            if ($this->group) {
                $this->visible = true;
            } else {
                // Если пользователь не найден, скрываем карточку и сбрасываем данные
                $this->resetUserData();
            }
    }

    public function daySelected($selectedDay) {
        $this->selectedDay = $selectedDay;
    }

    public function helpers1Selected($idHelper) {
        $this->helper1 = User::find($idHelper);
    }

    public function helpers2Selected($idHelper) {
        $this->helper2 = User::find($idHelper);
    }

    /**
     * Сохраняем изменения в группе
     * @return void
     */
    public function updateGroup (GroupSettingsNotifyBuilder $groupSettingsNotifyBuilder)
    {
        $this->group->time = $this->hour . ':' . $this->minutes . ':00';
        $this->group->weekday = $this->selectedDay;
        $this->group->place = $this->place;
        $this->group->save();

        if ($this->helper1) {
            $this->updateHelperInTransaction ($this->helper1, $this->helper1Old);
        }

        if ($this->helper2) {
            $this->updateHelperInTransaction ($this->helper2, $this->helper2Old);
        }

        $data = [
            'group' => $this->group,
            'time' => $this->hour . ':' . $this->minutes,
            'weekday' => $this->selectedDay,
            'place' => $this->place,
            'helper1' => $this->helper1,
            'helper2' => $this->helper2,
        ];

        $groupSettingsNotifyBuilder->handle($data);

        $this->dispatchBrowserEvent('closeSettingsModal');

    }

    /**
     * сохраняем новых помошников координатора и удаляем старных, если они изменились
     * @param $helperSelected
     * @param $helperOld
     * @return void|null
     */
    public function updateHelperInTransaction ($helperSelected, $helperOld)
    {
        //проверяем существет ли уже этот помощник в базе
        $existingHelper = $this->group->helpers()
            ->wherePivot('group_id', $this->group->id)
            ->wherePivot('user_id', $helperSelected->id)
            ->first();

        // Если существует выходим
        if ($existingHelper) return;

        //Проверка на перезапись- Если ранее существующей записи не было - добавляем
        if (!$helperOld) {
            $this->group->helpers()->attach($helperSelected->id);
        } else {
            // Если была - запускаем транзакцию
            DB::beginTransaction();

            try {
                $this->group->helpers()->attach($helperSelected->id);
                $this->group->helpers()->detach($helperOld->id);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }
    }
    public function hide()
    {
        $this->visible = false;
        $this->emitUp('groupSelected', null); // Эмитируем событие, чтобы сбросить состояние в вызывающем компоненте
    }
    public function resetUserData()
    {
        $this->group = null;
        $this->visible = false;
        $this->loading = false;
    }
    public function updated()
    {
        $this->dispatchBrowserEvent('dropdownsUpdated');
    }

    public function render()
    {
        return view('livewire.personal.modals.group-settings');
    }
}
