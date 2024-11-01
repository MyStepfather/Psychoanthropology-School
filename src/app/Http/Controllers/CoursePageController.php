<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CoursePageController extends Controller
{
    public function course($id)
    {
        // $id - это значение переданного динамического ID

        $course = Course::whereId($id)->first();

        return view('course', compact('course'));
    }
}
