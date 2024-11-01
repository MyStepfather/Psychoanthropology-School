<?php

namespace App\Filament\Resources\StansResource\Pages;

use App\Filament\Resources\StansResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStans extends ListRecords
{
    protected static string $resource = StansResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
