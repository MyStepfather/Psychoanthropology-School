<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\MediaResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;

class MediaResResource extends ModelResource
{
    protected string $model = MediaResource::class;

    protected string $title = 'Медиа Ресурсы';

    protected string $sortDirection = 'ASC';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                File::make('Медиа', 'url')
                    ->removable()
                    ->disk('public')
                    ->keepOriginalFileName(),
                BelongsTo::make('Язык', 'language', resource: new LanguageResource()),
                BelongsTo::make('Артист', 'artist', resource: new ArtistResource()),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
