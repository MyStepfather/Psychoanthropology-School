<?php

namespace App\Filament\Resources\TownResource\Pages;

use App\Filament\Resources\TownResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTowns extends ListRecords
{
    protected static string $resource = TownResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
