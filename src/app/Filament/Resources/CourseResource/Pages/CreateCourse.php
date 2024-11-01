<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = CourseResource::class;
}
