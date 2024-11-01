<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Constants\MediaTypes;
use App\Filament\Resources\VideoResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateVideo extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = VideoResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['type'] = MediaTypes::VIDEO;
        $media = $this->getModel()::create($data);
        return $media;
    }
}
