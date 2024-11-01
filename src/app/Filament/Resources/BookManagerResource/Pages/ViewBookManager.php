<?php

namespace App\Filament\Resources\BookManagerResource\Pages;

use App\Filament\Resources\BookManagerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBookManager extends ViewRecord
{
    protected static string $resource = BookManagerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
