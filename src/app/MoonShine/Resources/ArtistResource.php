<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

class ArtistResource extends ModelResource
{
    protected string $model = Artist::class;

    protected string $title = 'Авторы';
    protected string $column = 'name';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $showInModal = true;

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Имя', 'name')
                    ->sortable()
                    ->required()
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
