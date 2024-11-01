<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Date;

class EventResource extends ModelResource
{
    protected string $model = Event::class;

    protected string $title = 'События';
    protected string $column = 'title';

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Тип ивента', 'eventType', 'name'),
                Text::make('Заголовок', 'title', fn ($event) => $event->title ? $event->title : '-')
                    ->required(),
                Text::make('Текст', 'text', fn ($event) => $event->text ? $event->text : '-')
                    ->required(),
                Date::make('Дата начала', 'date_start')
                    ->required(),
                Date::make('Дата окнончания', 'date_end')
                    ->required(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
