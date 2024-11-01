<?php

namespace App\Filament\Resources\CouncilResource\Pages;

use App\Filament\Resources\CouncilResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCouncils extends ListRecords
{
    protected static string $resource = CouncilResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
