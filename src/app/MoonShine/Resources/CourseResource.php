<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

use MoonShine\CKEditor\Fields\CKEditor;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Heading;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Handlers\ExportHandler;
use MoonShine\Handlers\ImportHandler;
use MoonShine\Resources\ModelResource;

class CourseResource extends ModelResource
{
    protected string $model = Course::class;

    protected string $title = 'Курсы';

    protected string $column = 'name';
    protected string $sortColumn = 'number';

    public function fields(): array
    {
        return [
            ID::make()->sortable()->readonly(),

            Grid::make([
                Column::make([
                    Block::make('Основная информация', [
                        Number::make('Номер', 'number')
                            ->sortable()
                            ->hint('Номер курса')
                            ->required(),
                        Text::make('Название', 'name')
                            ->sortable(),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('Даты', [
                        Tabs::make([
                            Tab::make('Даты действия', [
                                Heading::make('Даты действия'),
                                Date::make('Дата начала действия', 'date_start')
                                    ->format('d.m.Y'),
                                Date::make('Дата окончания действия', 'date_end')
                                    ->format('d.m.Y'),
                            ]),

                            Tab::make('Дата редактирования', [
                                Date::make('Дата создания', 'created_at')
                                    ->format('d.m.Y')
                                    ->readonly(),
                            ]),
                        ]),
                    ]),
                ])->columnSpan(6),
                //                Column::make([
                //                    CKEditor::make('Текст', 'text')
                //                        ->hideOnIndex(),
                //                ]),

            ]),


        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function import(): ?ImportHandler
    {
        return null;
    }

    public function export(): ?ExportHandler
    {
        return null;
    }
    // public function actions(): array
    // {
    //     return [
    //         FiltersAction::make(trans('moonshine::ui.filters')),
    //     ];
    // }
}
