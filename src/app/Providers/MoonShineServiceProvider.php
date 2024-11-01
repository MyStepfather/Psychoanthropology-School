<?php

namespace App\Providers;

use App\Models\Course;
use App\MoonShine\Resources\ArtistResource;
use App\MoonShine\Resources\BookManagerResource;
use App\MoonShine\Resources\CourseResource;
use App\MoonShine\Resources\Directory\CouncilResource;
use App\MoonShine\Resources\Directory\CountryResource;
use App\MoonShine\Resources\Directory\TownResource;
use App\MoonShine\Resources\EventResource;
use App\MoonShine\Resources\EventTypeResource;
use App\MoonShine\Resources\ExerciseResource;
use App\MoonShine\Resources\GroupResource;
use App\MoonShine\Resources\LanguageResource;
use App\MoonShine\Resources\MediaResResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\MediaResource;
use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\VideoResource;
use MoonShine\Menu\MenuDivider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function menu(): array
    {
        return [
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('heroicons.users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('heroicons.bookmark'),
            ])->translatable(),

            MenuGroup::make('Справочник', [
            ])->icon('heroicons.map'),

            MenuGroup::make('Контент', [
                MenuItem::make('Курсы', new CourseResource())->icon('heroicons.document-text')
                    ->badge(fn () => Course::query()->count() . ''),
                MenuItem::make('Новости', new NewsResource())->icon('heroicons.newspaper'),
                MenuItem::make('Видео', new VideoResource())->icon('heroicons.video-camera'),
                MenuItem::make('Ресурсы', new MediaResResource())->icon('heroicons.video-camera'),
                MenuItem::make('Стансы', new MediaResource())->icon('heroicons.video-camera'),
                MenuItem::make('События', new EventResource())->icon('heroicons.calendar-days'),
                MenuItem::make('Упражнения', new ExerciseResource())->icon('heroicons.rocket-launch'),
            ])->icon('heroicons.outline.clipboard-document-check'),

            MenuGroup::make('Пользователи и группы', [
                MenuItem::make('Пользователи', new UserResource())->icon('heroicons.outline.users'),
                MenuItem::make('Группы', new GroupResource())->icon('heroicons.outline.users'),
                MenuItem::make('Заказ книг', new BookManagerResource())->icon('heroicons.outline.book-open'),
            ]),
            MenuDivider::make(),
            MenuGroup::make('Данные', [
                MenuItem::make('Страны', new CountryResource())->icon('heroicons.map-pin'),
                MenuItem::make('Города', new TownResource())->icon('heroicons.map-pin'),
                MenuItem::make('Типы событий', new EventTypeResource())->icon('heroicons.calendar-days'),
                MenuItem::make('Авторы', new ArtistResource())->icon('heroicons.microphone'),
                MenuItem::make('Языки', new LanguageResource())->icon('heroicons.language'),
                MenuItem::make('Совет', new CouncilResource())->icon('heroicons.map-pin'),

            ])
        ];
    }
}
