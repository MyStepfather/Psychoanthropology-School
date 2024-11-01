<?php

namespace App\Filament\Resources\ExerciseResource\Pages;

use App\Filament\Resources\ExerciseResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExercise extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = ExerciseResource::class;
}
