<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

use MoonShine\Exceptions\FieldException;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Date;
use MoonShine\Fields\Switcher;
use Illuminate\Support\Carbon;

class ExerciseResource extends ModelResource
{
    protected string $model = Exercise::class;

    protected string $title = 'Упражнения';
    protected string $column = 'title';

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'ASC';

    /**
     * @throws FieldException
     */
    public function fields(): array
    {
        Carbon::now();
        return [
            Block::make([
                ID::make()->sortable(),
                Select::make('Тип упражнения', 'type')
                    ->options([
                        1 => 'Ежедневное',
                        0 => 'Актуальное'
                    ])
                    ->required(),
                Text::make('Заголовок', 'title')->required(),
                TinyMce::make('Текст', 'text')->required()->hideOnIndex(),
                Switcher::make('Опубликовать', 'published_at')
                    ->onValue(Carbon::now()->toDayDateTimeString())
                    ->offValue(0)
                    ->default(false)
                    ->updateOnPreview(),
                // Date::make('Дата публикации', 'published_at'),
                Text::make('Месяц', 'month')->default(null),
                Date::make('Дата', 'date')->required(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
