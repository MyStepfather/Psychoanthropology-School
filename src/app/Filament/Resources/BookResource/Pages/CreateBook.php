<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Constants\MediaTypes;
use App\Filament\Resources\BookResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBook extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = BookResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['type'] = MediaTypes::BOOK;
        $media = $this->getModel()::create($data);
        return $media;
    }
}
