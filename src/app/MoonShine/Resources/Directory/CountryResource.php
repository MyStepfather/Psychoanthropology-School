<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Directory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;

class CountryResource extends ModelResource
{
    protected string $model = Country::class;

    protected string $title = 'Страны';
    protected string $column = 'name';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $showInModal = true;

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';



    // public $countryId = Country::query()->get();

    public function fields(): array
    {
        return [
            Block::make([
                ID::make('ID', 'id')
                    ->readonly()
                    ->sortable(),
                Text::make('Имя', 'name')
                    ->sortable()
                    ->required(),
//                 BelongsTo::make('Совет', 'council', 'name')
//                 ->valuesQuery(fn ($query) => $query->where('parent_id' == $countryId->id))
//                 ->hideOnCreate()
//                 ->hideOnForm()
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
