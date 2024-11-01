<?php

namespace App\Actions\Page\Personal;

use App\Helpers\GetDateHelper;
use App\Models\Group;
use MoveMoveIo\DaData\Facades\DaDataName;

class GetGroupTodayAction
{
    public function handle()
    {

        $todayDayNumber = GetDateHelper::getCurrentWeekDay();
        $groups = Group::where('weekday', $todayDayNumber)->get();

        //Получаем в родительном падеже имя координатора, Платная история отказ
        //        foreach ($groups as $group) {
        //            $dadata = DaDataName::standardization($group->coordinator->name);
        //
        //            $group->coordinatorNameGenetive = $dadata[0]['result_genitive'];
        //        }

        return $groups;

    }
}
