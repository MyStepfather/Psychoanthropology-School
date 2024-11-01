<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateGroup extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = GroupResource::class;
}
