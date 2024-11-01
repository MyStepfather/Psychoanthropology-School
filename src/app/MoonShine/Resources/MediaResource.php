<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Media;
use App\Models\Stans;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;

class MediaResource extends ModelResource
{
    protected string $model = Media::class;

    protected string $title = 'Стансы';

    protected string $sortDirection = 'ASC';

    public function query(): Builder
    {
        return parent::query()->whereHas('stans', function ($query) {
        });
    }

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make('Создание станса', [
//                        ID::make()->sortable(),
                        HasOne::make('Номер станса', 'stans', fn($item) => "$item->number.)", resource: new StansResource()),
                        Text::make('Название', 'name', ),
                        Date::make('Дата начала', 'date_start')->format('d.m.Y'),
                        Date::make('Дата окончания', 'date_end')->format('d.m.Y'),
                    ]),
                ]),
//                Column::make([
//                    Block::make('Музыка станса', [
////                        Json::make('Музыка')
//                        BelongsTo::make('Название', 'media', resource: new MediaResource()),
//                        File::make('Файл музыки', '')
//
//                    ]),
//                ]),
//                Column::make([
//                    Block::make('Тексты станса', [
//                        BelongsTo::make('Название', 'media', resource: new MediaResource()),
//                    ]),
//                ]),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
