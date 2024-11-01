<?php

namespace App\Filament\Resources\ContentResource\Pages;

use App\Filament\Resources\ContentResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContent extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = ContentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
