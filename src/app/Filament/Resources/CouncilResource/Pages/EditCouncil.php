<?php

namespace App\Filament\Resources\CouncilResource\Pages;

use App\Filament\Resources\CouncilResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCouncil extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = CouncilResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
