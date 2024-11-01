<?php

namespace App\Filament\Resources\SongResource\Pages;

use App\Constants\MediaTypes;
use App\Filament\Resources\SongResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSong extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = SongResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['type'] = MediaTypes::AUDIO;
        $media = $this->getModel()::create($data);
        return $media;
    }
}
