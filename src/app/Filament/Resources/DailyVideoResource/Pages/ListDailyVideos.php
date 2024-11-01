<?php

namespace App\Filament\Resources\DailyVideoResource\Pages;

use App\Filament\Resources\DailyVideoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyVideos extends ListRecords
{
    protected static string $resource = DailyVideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
