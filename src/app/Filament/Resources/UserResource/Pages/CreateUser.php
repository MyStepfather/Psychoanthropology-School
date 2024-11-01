<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Classes\RedirectOnIndexHandler\TraitRedirectOnIndex;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    use TraitRedirectOnIndex;
    protected static string $resource = UserResource::class;



    protected function handleRecordCreation(array $data): Model
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->getModel()::create($data);
    }
}
