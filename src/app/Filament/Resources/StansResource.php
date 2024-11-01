<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StansResource\Pages;
use App\Models\Media;
use App\Models\Stans;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StansResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $modelLabel = 'Станс';
    protected static ?string $pluralModelLabel = 'Стансы';
    protected static ?string $navigationIcon = 'heroicon-o-pause';
    protected static ?string $slug = 'stanses';
    protected static ?string $navigationGroup = 'Медиа';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('number_temporary_var')
                            ->label('Номер')
                            ->required()
                            ->numeric(),

                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        TextInput::make('description')
                            ->label('Описание')
                            ->nullable(),

                        DatePicker::make('date_start_temporary_var')
                            ->label('Дата начала недели действия станса')
                            ->required(),

                        DatePicker::make('date_end_temporary_var')
                            ->label('Дата окончания недели действия станса')
                            ->required(),
                    ]),

                Section::make('Музыка Стансов')
                    ->schema([
                        Repeater::make('mediaResources')
                            ->label('Музыка')
                            ->relationship()
                            ->createItemButtonLabel('Добавить музыку')
                            ->schema([
                                Select::make('language_id')
                                    ->label('Язык')
                                    ->relationship('language', 'name')
                                    ->required(),
                                Select::make('artist_id')
                                    ->label('Исполнитель')
                                    ->relationship('artist', 'name')
                                    ->required(),
                                FileUpload::make('url')
                                    ->label('Файл музыки')
                                    ->preserveFilenames()
                                    ->directory('media/audio/stans')
                                    ->enableOpen()
                                    ->required()
                                    ->acceptedFileTypes([
                                        'audio/mpeg',   // MIME-тип для MP3
                                        'audio/wav',    // MIME-тип для WAV
                                        'audio/flac',   // MIME-тип для FLAC
                                    ]),
                            ]),
                    ]),

                Section::make('Тексты Стансов')
                    ->schema([
                        Repeater::make('mediaTexts')
                            ->label('Тексты')
                            ->relationship()
                            ->createItemButtonLabel('Добавить текст')
                            ->schema([
                                Select::make('language_id')
                                    ->label('Язык')
                                    ->required()
                                    ->relationship('language', 'name'),
                                TextInput::make('title')
                                    ->label('Название на языке')
                                    ->required(),
                                RichEditor::make('text')
                                    ->required()
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
                                    ]),
                            ]),
                    ]),

            ]);

    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('num')
                    ->label('Номер станса')
                    ->getStateUsing(function ($record) {
                        $stans = Stans::query()->where('media_id', $record->id)->first();
                        return $stans->number;
                    })
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start')
                    ->label('Начало станса')
                    ->placeholder('-')
                    ->getStateUsing(function ($record) {
                        $stans = Stans::query()->where('media_id', $record->id)->first();
                        return $stans->date_start;
                    })
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->sortable(),

                TextColumn::make('end')
                    ->label('Конец станса')
                    ->getStateUsing(function ($record) {
                        $stans = Stans::query()->where('media_id', $record->id)->first();
                        return $stans->date_end;
                    })
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->sortable(),
                ToggleColumn::make('stans.is_active')
                    ->label('Активный станс')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStans::route('/'),
            'create' => Pages\CreateStans::route('/create'),
            'edit' => Pages\EditStans::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->has('stanses');
    }
}
