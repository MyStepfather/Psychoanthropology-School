<?php

namespace App\Filament\Resources\DailyVideoResource\Pages;

use App\Filament\Resources\DailyVideoResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyVideo extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = DailyVideoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
