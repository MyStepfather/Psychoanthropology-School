<?php

namespace App\Http\Controllers;

use App\Actions\Page\Personal\GetCoursesAction;
use App\Actions\Page\Personal\GetDailyVideoAction;
use App\Actions\Page\Personal\GetGroupCouncilAction;
use App\Actions\Page\Personal\GetGroupTodayAction;
use App\Actions\Page\Personal\GetMyVideoAction;
use App\Actions\Subscribes\GetSubscribesAction;
use App\Constants\SubscribesTypes;
use App\Constants\ProductVideoCategories;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PersonalPageController extends Controller
{
    public function showPersonalPage(GetCoursesAction $getCourse,
        GetDailyVideoAction $getDailyVideo,
        GetSubscribesAction $getSubscribe,
        GetGroupTodayAction $getGroupTodayAction,
        GetGroupCouncilAction $getGroupCouncilAction)
    {
        $user = Auth::user();
        //         Проверяем является ли коориднатором и членом совета

        $data['coordinator'] = Group::where('coordinator_user_id', $user->id)->first();
        $data['councilsOfUser'] = User::find($user->id)->councils()->where('user_id', $user->id)->get();

        /**
         * Получаем курсы
         */
        $data['courses'] = $getCourse->handle($user);

        /**
         * Получаем ежедневные видео
         */
        $activeSubscribe = $getSubscribe
            ->handle($user, [
                SubscribesTypes::VIDEO,
                SubscribesTypes::ZOOM,
            ], 'active');
        if ($activeSubscribe) {
            $data['dailyVideos'] = 1;
        } else {
            $data['dailyVideos'] = 0;
        }

        /**
         * Получаем группы сегодня
         */
        $data['groupsToday'] = $getGroupTodayAction->handle();

        /**
         * Получаем группы региона для Члена Совета
         */
        $data['councilGroups'] = $getGroupCouncilAction->handle($data['councilsOfUser']);

        return view('personal',
            compact('user', 'data'));
    }

     public function showMyVideoPage(GetMyVideoAction $getVideo, GetSubscribesAction $getSubscribe)
     {
         $user = Auth::user();

         $activeSubscribe = $getSubscribe
             ->handle($user, [
                 SubscribesTypes::VIDEO,
                 SubscribesTypes::ZOOM,
             ], 'active');

         $myVideo = $getVideo->handle($user, [
             ProductVideoCategories::FORMATION,
             ProductVideoCategories::STAGE,
             ProductVideoCategories::COLLECTION,
         ]);

         return view('partials.personal.my_video',
             compact('user', 'activeSubscribe', 'myVideo'));
     }

     public function showDailyVideoPage()
     {
         /**
          *  Livewire компонент
          */
         return view('partials.personal.daily_video');
     }

     public function showFormationVideoPage(GetMyVideoAction $action)
     {
         $user = Auth::user();

         $myVideo = $action->handle($user, [ProductVideoCategories::FORMATION]);

         return view('partials.personal.formation_video',
             compact('user', 'myVideo'));

     }

    public function showStageVideoPage(GetMyVideoAction $action)
    {
        $user = Auth::user();

        $myVideo = $action->handle($user, [ProductVideoCategories::STAGE]);

        return view('partials.personal.stage_video',
            compact('user', 'myVideo'));

    }

    public function showCollectionVideoPage(GetMyVideoAction $action)
    {
        $user = Auth::user();

        $myVideo = $action->handle($user, [ProductVideoCategories::COLLECTION]);

        return view('partials.personal.collection_video',
            compact('user', 'myVideo'));

    }
    public function course($id)
    {
        // $id - это значение переданного динамического ID

        $course = Course::whereId($id)->first();

        return view(null, compact('course'));
    }
}
