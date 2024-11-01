<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Carbon;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $modelLabel = 'Упражнение';
    protected static ?string $pluralModelLabel = 'Упражнения';

    public function setNowDate($record)
    {
        $record->published_at = now();
        $record->save();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('title')
                            ->label('Название')
                            ->required(),

                        Select::make('type')
                            ->options([
                                0 => 'Актуальные',
                                1 => 'Ежедневные',
                            ])
                            ->default(0)
                            ->disablePlaceholderSelection(),

                        RichEditor::make('text')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->label('Текст')
                            ->required(),
                    ]),

                Section::make('Даты и время')
                    ->schema([
//                        DatePicker::make('month')
//                            ->label('Месяц, в котором дано упражнение')
//                            ->format('F')
//                            ->nullable(),

                        DatePicker::make('date')
                            ->label('Дата упражнения')
                            ->withoutSeconds()
                            ->nullable(),

//                        DatePicker::make('published_at')
//                            ->label('Дата публикации')
//                            ->nullable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Тип')
                    ->getStateUsing(fn ($record) =>
                        $record->type === 1 ? 'Ежедневные' : 'Актуальные')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

//                TextColumn::make('month')
//                    ->label('Месяц в котором дано упражнение')
//                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('F'))
//                    ->searchable()
//                    ->sortable(),

                TextColumn::make('date')
                    ->label('Дата упражнения')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->searchable()
                    ->sortable(),

//                TextColumn::make('published_at')
//                    ->label('Дата публикации')
//                    ->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->locale('ru')->translatedFormat('d F Y') : null)
//                    ->placeholder('-')
//                    ->searchable()
//                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('Опубликовать')
                    ->action(function($records) {
                        $records->each(function ($record) {
                            $record->published_at = now();
                            $record->save();
                        });
                    }),
                BulkAction::make('Снять')
                    ->action(function($records) {
                        $records->each(function ($record) {
                            $record->published_at = null;
                            $record->save();
                        });
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
