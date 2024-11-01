<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = EventResource::class;
}
