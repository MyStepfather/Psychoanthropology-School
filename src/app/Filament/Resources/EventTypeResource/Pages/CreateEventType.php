<?php

namespace App\Filament\Resources\EventTypeResource\Pages;

use App\Filament\Resources\EventTypeResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateEventType extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = EventTypeResource::class;
}
