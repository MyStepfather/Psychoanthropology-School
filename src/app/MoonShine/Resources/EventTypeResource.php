<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventType;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class EventTypeResource extends ModelResource
{
    protected string $model = EventType::class;

    protected string $title = 'Типы Событий';
    protected string $column = 'name';

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название', 'name')->required()

            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
