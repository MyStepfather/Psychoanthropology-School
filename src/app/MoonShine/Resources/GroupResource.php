<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use MoonShine\Fields\Preview;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Select;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

//TODO помощники(выборка из этой группы)
class GroupResource extends ModelResource
{
    protected string $model = Group::class;
    protected string $title = 'Группы';
    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable()->readonly(),
                Text::make('Тип группы', 'type', function($v) {
                    switch ($v->type) {
                        case 'work';
                            return '5 Пути';
                        case 'read';
                            return 'Чтения';
                        case 'new';
                            return 'Новичков/открытия';
                    }
                })->hideOnForm()->readonly()->sortable(),
                Select::make('Тип группы', 'type')
                    ->options([
                        'work' => '5 Пути',
                        'read' => 'Чтения',
                        'new' => 'Новичков/открытия'
                    ])->required()->hideOnIndex()->hideOnDetail(),
                BelongsTo::make('Страна', 'country', 'name')->nullable(),
                BelongsTo::make('Город', 'town', 'name')->associatedWith('country_id')->searchable()->nullable(),
                BelongsTo::make('Координатор', 'coordinator',
                    fn($v) => $v->name_first . ' ' . $v->name_last, new UserResource())
                    ->searchable()->nullable(),
                Preview::make('День проведения', 'weekday',
                    fn($data) => now()->startOfWeek($data->weekday)->locale('ru')->isoFormat('dddd'))
                    ->hideOnForm()->readonly()->sortable(),
                Select::make('День проведения', 'weekday')
                    ->options([
                        1 => 'Понедельник',
                        2 => 'Вторник',
                        3 => 'Среда',
                        4 => 'Четверг',
                        5 => 'Пятница',
                        6 => 'Суббота',
                        7 => 'Воскресенье',
                    ])->hideOnIndex()->hideOnDetail()->nullable(),
                Text::make('Время проведения', 'time',
                    fn($data) => Carbon::parse($data->time)->isoFormat('HH:mm'))
                    ->customAttributes(['type' => 'time'])->nullable(),
                BelongsToMany::make('Помощники', 'helpers',
                    fn($v) => $v->name_first . ' ' . $v->name_last, new GroupResource()
                )
                    ->nullable()
                    ->columnLabel('Помощник')
                    ->selectMode()
                    ->hideOnIndex()
                    ->inLine(separator: ' ', badge: true)
                    ->customAttributes([
                        'data-max-item-count' => 2
                    ]),
                Switcher::make('Группа активна?', 'is_active')->hideOnIndex()->default(true),
                Switcher::make('Группа онлайн?', 'is_online')->hideOnIndex()->default(false),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return [];
    }
}
