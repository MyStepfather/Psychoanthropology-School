<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['group_town_id'] = $this->record->group->town_id;
        $data['group_country_id'] = $this->record->group->country_id ?? $this->record->group->town->country_id;
        //        $data['group_coordinator_user_id'] = $this->record->group->coordinator_user_id;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['group_country_id']);
        unset($data['group_town_id']);

        return $data;
    }

//    protected function handleRecordUpdate(Model $record, array $data): Model
//    {
//        return parent::handleRecordUpdate($record, $data); // TODO: Change the autogenerated stub
//    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['new_password']) {
            $data['password'] = Hash::make($data['new_password']);
        }
        unset($data['new_password']);
        $record->update($data);
        return $record;
    }
}
