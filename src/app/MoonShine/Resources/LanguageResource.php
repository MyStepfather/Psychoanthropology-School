<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Language;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

class LanguageResource extends ModelResource
{
    protected string $model = Language::class;

    protected string $title = 'Языки';
    protected string $column = 'name';

    protected bool $createInModal = true;
    protected bool $editInModal = true;
    protected bool $detailInModal = true;

    protected string $sortColumn = 'name';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Язык', 'name')
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
