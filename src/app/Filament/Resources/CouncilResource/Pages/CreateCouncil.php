<?php

namespace App\Filament\Resources\CouncilResource\Pages;

use App\Filament\Resources\CouncilResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateCouncil extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = CouncilResource::class;
}
