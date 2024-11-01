<?php

namespace App\Filament\Resources\DailyVideoResource\Pages;

use App\Filament\Resources\DailyVideoResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateDailyVideo extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = DailyVideoResource::class;
}
