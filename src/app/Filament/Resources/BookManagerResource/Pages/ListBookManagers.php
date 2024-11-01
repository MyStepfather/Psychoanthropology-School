<?php

namespace App\Filament\Resources\BookManagerResource\Pages;

use App\Filament\Resources\BookManagerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookManagers extends ListRecords
{
    protected static string $resource = BookManagerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
