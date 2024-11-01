<?php

namespace App\Actions\Page\Personal;

use App\Models\Council;
use MoveMoveIo\DaData\Facades\DaDataName;

class GetGroupCouncilAction
{
    public function handle($councils)
    {

        $councilGroups = $councils->map(function ($council) {
            $councilWithTowns = Council::with(['towns.groups.coordinator'])
                ->find($council->id);

            return $councilWithTowns;
        });

        //        foreach ($councilGroups  as $councilGroup) {
        //            foreach ($councilGroup->towns as $town) {
        //                foreach ($town->groups as $group) {
        //                    $dadata = DaDataName::standardization($group->coordinator->name);
        //
        //                    $group->coordinatorNameGenetive = $dadata[0]['result_genitive'];
        //                }
        //            }
        //        }
        return $councilGroups;

    }
}
