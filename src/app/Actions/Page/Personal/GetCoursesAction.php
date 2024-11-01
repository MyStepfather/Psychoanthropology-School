<?php

namespace App\Actions\Page\Personal;

use App\Constants\GroupTypes;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;

class GetCoursesAction
{
    public function handle($user)
    {
        $courses = [];
        $currentWeekStart = Carbon::now()->startOfWeek(); // Начало текущей недели
        $nextWeekStart = Carbon::now()->startOfWeek()->addWeek(); // Начало следующей недели

        /**
         * Получение курса для Рабочей группы (общий для всех групп)
         */
        if ($user->group->type === GroupTypes::WORK) {
            $courses['currentCourse'] = Course::whereDate('date_start', '<=', $currentWeekStart)
                ->whereDate('date_end', '>=', $currentWeekStart)
                ->first();

            $courses['nextCourse'] = Course::whereDate('date_start', '>=', $nextWeekStart)
                ->whereDate('date_start', '<=', $nextWeekStart->copy()->endOfWeek())
                ->first();
        }

        /**
         * Получение курса для группы Чтения (индивидуальный для группы)
         */
        if ($user->group->type === GroupTypes::READ) {
            $group = User::find($user->id)->group;

            $courses['currentCourse'] = $group->courses()
                ->whereDate('group_course.date_start', '<=', $currentWeekStart)
                ->whereDate('group_course.date_end', '>=', $currentWeekStart)
                ->first();

            $courses['nextCourse'] = $group->courses()
                ->whereDate('group_course.date_start', '>=', $nextWeekStart)
                ->whereDate('group_course.date_start', '<=', $nextWeekStart->copy()->endOfWeek())
                ->first();
        }

        return $courses;

    }
}
