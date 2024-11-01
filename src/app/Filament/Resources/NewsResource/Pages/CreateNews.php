<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateNews extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = NewsResource::class;
}
