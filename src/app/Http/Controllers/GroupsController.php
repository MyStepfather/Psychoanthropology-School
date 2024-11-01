<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Group;
use App\Constants\GroupTypes;
use App\Models\Town;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function getGroups($type)
    {
        $groupQuery = Group::query()
            ->where('type', $type)
            ->where('is_active', 1)
            ->select('id','coordinator_user_id', 'country_id', 'town_id', 'weekday', 'time');
        return $groupQuery->with([
            'coordinator:id,name_first,name_last',
            'town:id,name',
            'country:id,name'
        ])->get();
    }

    public function showFiveWay()
    {
        $arrFiveWays = $this->getGroups(GroupTypes::WORK);
        return view('aboutSchool', compact('arrFiveWays'));
    }

    public function showReading()
    {
        $arrReading = $this->getGroups(GroupTypes::READ);
        return view('aboutSchool', compact('arrReading'));
    }

    public function showBeginners()
    {
        $arrBeginners = $this->getGroups(GroupTypes::NEW);
        return view('aboutSchool', compact('arrBeginners'));
    }

    public function showCalendar(Request $request)
    {
        $arrGroups = [];
        $country = $request->input('country');
        $town = $request->input('town');
        $weekday = $request->input('weekday');
        $group = $request->input('group');
        $online = $request->input('online') ? "1" : null;
        $countries = Country::query()->select('id', 'name')->get();
        $towns = Town::query()->select('id', 'name', 'country_id')->get();

        if (!$country && !$town && !$weekday && !$group && !$online) {
            return view('aboutSchool', compact('arrGroups', 'countries', 'towns'));
        }

        $query = Group::query()
            ->where('is_active', 1)
            ->select('id', 'coordinator_user_id', 'country_id', 'town_id', 'weekday', 'time', 'is_online')
            ->with([
                'coordinator:id,name_first,name_last',
                'town:id,name',
                'country:id,name'
            ])
            ->orderByDesc('is_online');

        if ($country) $query->where('country_id', $country);
        if ($town) $query->where('town_id', $town);
        if ($weekday) $query->where('weekday', $weekday);
        if ($group) $query->where('type', $group);
        if ($online) $query->where('is_online', $online);
        $arrGroups = $query->get();

        return view('aboutSchool', compact('arrGroups', 'countries', 'towns'));
    }
}
