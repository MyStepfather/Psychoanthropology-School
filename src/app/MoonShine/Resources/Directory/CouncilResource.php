<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Directory;

use App\MoonShine\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use App\Models\Council;
use MoonShine\Fields\Date;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use MoonShine\Fields\Select;

class CouncilResource extends ModelResource
{
    protected string $model = Council::class;

    protected string $title = 'Представительства';

    protected string $sortColumn = 'id';
    protected string $column = 'name';
    protected string $sortDirection = 'ASC';

// TODO Связать council с town и country, user
    public function fields(): array
    {
        return [
            Block::make([
                ID::make('id'),
                Text::make('Название', 'name'),
                HasMany::make( 'Страны', 'countries', resource: new CountryResource())
                    ->hideOnDetail()
                    ->hideOnIndex()
                    ->hideOnForm()
                    ->hideOnCreate()
                    ->onlyLink()
                    ->searchable(false),
                HasMany::make( 'Города', 'towns', resource: new TownResource())
                    ->hideOnDetail()
                    ->hideOnIndex()
                    ->hideOnForm()
                    ->hideOnCreate()
                    ->onlyLink()
                    ->searchable(false),
                belongsToMany::make( 'Руководители', 'users', resource: new UserResource())
                    ->badge('purple')
                    ->onlyCount()
                    ->fields([
                        Text::make('Руководители', 'user_id', fn($row) => $row->name_first .' '. $row->name_last)
                    ])
                    ->selectMode(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
