<?php

namespace App\Filament\Resources\BookManagerResource\Pages;

use App\Filament\Resources\BookManagerResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateBookManager extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = BookManagerResource::class;
}
