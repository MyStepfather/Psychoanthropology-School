<?php

namespace App\Filament\Resources\ArtistResource\Pages;

use App\Filament\Resources\ArtistResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtist extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = ArtistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
