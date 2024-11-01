<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Directory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Town;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

class TownResource extends ModelResource
{
    protected string $model = Town::class;
    protected string $title = 'Города';
    protected string $column = 'name';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make('ID', 'id')
                    ->readonly()
                    ->sortable(),
                Text::make('Город', 'name')
                    ->sortable()
                    ->required(),
                BelongsTo::make('Страна', 'country', 'name')
                    ->required(),
//                    ->hideOnIndex()
//                 ->hideOnForm()
//                 ->hideOnCreate(),
                BelongsTo::make('Представительство', 'council', 'name')
                    ->required(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
