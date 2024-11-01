<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Image;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Resources\ModelResource;

//TODO добавление group_id, password, social

class UserResource extends ModelResource
{
    protected string $model = User::class;
    protected string $title = 'Пользователи';
    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';
    protected string $column = 'name_first';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable()->readonly(),
                Text::make('Логин', 'login')->sortable()->nullable(),
                Text::make('Пароль', 'password')->hideOnIndex()->hideOnForm()->readonly(),
                Email::make('Email', 'email')->required(),
                Phone::make('Телефон', 'phone')->mask('7 999 999-99-99')->nullable(),
                Text::make('Telegram')->hideOnIndex()->nullable(),
                Text::make('Имя', 'name_first')->sortable()->nullable(),
                Text::make('Фамилия', 'name_last')->sortable()->nullable(),
                Text::make('Отчество', 'name_middle')->sortable()->nullable(),
                Image::make('Аватар', 'avatar')
                    ->nullable()
                    ->hideOnIndex()
                    ->disk('public')
                    ->dir('image/avatars')
                    ->allowedExtensions(['jpg', 'png', 'jpeg', 'webp']),
                Date::make('Дата поступления в школу', 'entered_at')->nullable()->hideOnIndex(),
                Date::make('Дата рождения', 'birthdate')->nullable()->hideOnIndex(),
                BelongsTo::make('Группа', 'group', function($v) {
                    switch ($v->type) {
                        case 'work';
                            return '5 Пути';
                        case 'read';
                            return 'Чтения';
                        case 'new';
                            return 'Новичков/открытия';
                    }
                })->hideOnForm()->nullable()->readonly(),
                Switcher::make('Активен?', 'is_active')->hideOnIndex()->default(true),
                Switcher::make('Данные видны другим?', 'is_public')->hideOnIndex()->default(true),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['login', 'name_first', 'name_last', 'name_middle', 'email', 'phone'];
    }

    public function filters(): array
    {
        return [];
    }
}
