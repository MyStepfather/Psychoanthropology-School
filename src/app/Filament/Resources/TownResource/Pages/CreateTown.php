<?php

namespace App\Filament\Resources\TownResource\Pages;

use App\Filament\Resources\TownResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTown extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = TownResource::class;
}
