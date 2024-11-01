<?php

namespace App\Filament\Resources\LanguageResource\Pages;

use App\Filament\Resources\LanguageResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateLanguage extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = LanguageResource::class;
}
