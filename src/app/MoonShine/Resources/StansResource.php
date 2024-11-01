<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Stans;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

use MoonShine\Fields\Number;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class StansResource extends ModelResource
{
    protected string $model = Stans::class;

    protected string $title = 'Media';

//    protected string $column = 'name';

    public function fields(): array
    {
        return [
//            Number::make('Номер станса', 'number')->hideOnIndex()->inLabel()
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
