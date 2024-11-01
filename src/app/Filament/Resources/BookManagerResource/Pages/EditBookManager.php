<?php

namespace App\Filament\Resources\BookManagerResource\Pages;

use App\Filament\Resources\BookManagerResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBookManager extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = BookManagerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
