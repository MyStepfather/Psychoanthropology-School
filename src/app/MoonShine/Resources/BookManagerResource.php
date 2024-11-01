<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookManager;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class BookManagerResource extends ModelResource
{
    protected string $model = BookManager::class;
    protected string $title = 'Заказ книг';
    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable()->readonly(),
                BelongsTo::make('Ответсвенный за заказ книг', 'user',
                fn($v) => $v->name_first . ' ' . $v->name_last, new UserResource())->searchable()->required(),
                Text::make('Название региона/города', 'name')->nullable(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
