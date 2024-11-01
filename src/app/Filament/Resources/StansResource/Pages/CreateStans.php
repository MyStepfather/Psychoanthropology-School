<?php

namespace App\Filament\Resources\StansResource\Pages;

use App\Constants\MediaTypes;
use App\Filament\Resources\StansResource;
use App\Models\Stans;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateStans extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = StansResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $number = $data['number_temporary_var'];
        $dateStart = $data['date_start_temporary_var'];
        $dateEnd = $data['date_end_temporary_var'];
        unset($data['number_temporary_var']);
        unset($data['date_start_temporary_var']);
        unset($data['date_end_temporary_var']);
        $data['type'] = MediaTypes::AUDIO;
        $media = $this->getModel()::create($data);

        Stans::create([
            'media_id' => $media->id,
            'number' => $number,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
        ]);

        return $media;
    }
}
