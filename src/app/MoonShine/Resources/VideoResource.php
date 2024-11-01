<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Media;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;


class VideoResource extends ModelResource
{
    protected string $model = Media::class;

    protected string $title = 'Видео';
    protected string $sortDirection = 'ASC';

    public function query(): Builder
    {
        return parent::query()->where('type', '=', 'video');
    }

    public function fields(): array
    {
        return [
            Block::make( [
                ID::make()->sortable()->readonly(),
                Text::make('Название Видео','name')
                    ->sortable(),
                Text::make('Описание', 'description')
                    ->sortable(),
                Switcher::make('Платный/Бесплатный', 'is_free')->updateOnPreview(),
                HasMany::make('Ресурсы', 'mediaResources', resource: new MediaResResource())
                    ->hideOnIndex()
                    ->fields([
                    File::make('Загрузить видео', 'url')
                        ->showOnDetail()
                        ->removable()
                        ->disk('public')
                        ->dir('media/video')
                        ->allowedExtensions(['mp4', 'avi', 'mov']),
                        BelongsTo::make('Язык', 'language'),
                        BelongsTo::make('Артист', 'artist', resource: new LanguageResource())
                ]),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
