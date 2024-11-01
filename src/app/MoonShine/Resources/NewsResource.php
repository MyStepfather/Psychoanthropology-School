<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Date;
use MoonShine\Fields\File;
use MoonShine\Fields\ID;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Image;
use MoonShine\Fields\Switcher;

use function Laravel\Prompts\text;

class NewsResource extends ModelResource
{
    protected string $model = News::class;

    protected string $title = 'Новости';
    protected string $column = 'title';

    protected string $sortColumn = 'id';
    protected string $sortDirection = 'DESC';
    public function fields(): array
    {
        return [
            ID::make()->sortable(),

            Grid::make([
                Column::make([
                    Block::make('Автор', [
                        BelongsTo::make('Автор', 'user', fn ($user) =>
                        $user->name_first . ' ' . $user->name_last)
                            ->readonly()
                            ->required()
                    ]),
                ]),
                Column::make([
                    Block::make('Новость', [
                        Text::make('Заголовок', 'title')->required(),
                        Text::make('Описание', 'description')->required(),
                        TinyMce::make('Текст', 'text')->hideOnIndex()->required(),
                        Image::make('Картинка', 'image_url')
                            ->disk('public')
                            ->dir('image/news')
                            ->allowedExtensions(['jpg', 'gif', 'png', 'jpeg']),
                        File::make('Видео', 'video_url')
                            ->disk('public')
                            ->allowedExtensions(['mp4', 'avi', 'mov']),
                        Switcher::make('Опубликовать', 'is_show')->updateOnPreview(),
                        Date::make('Создано', 'created_at')
                    ]),
                ])
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
