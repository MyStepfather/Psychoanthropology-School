<?php

namespace App\Filament\Resources\ArtistResource\Pages;

use App\Filament\Resources\ArtistResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateArtist extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = ArtistResource::class;
}
