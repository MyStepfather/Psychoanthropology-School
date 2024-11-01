<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongResource\Pages;
use App\Filament\Resources\SongResource\RelationManagers;
use App\Models\Media;
use Filament\Forms\Components\Checkbox;
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

class SongResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $modelLabel = 'Песня';
    protected static ?string $pluralModelLabel = 'Песни';
    protected static ?string $navigationIcon = 'heroicon-o-pause';
    protected static ?string $slug = 'songs';
    protected static ?string $navigationGroup = 'Медиа';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        TextInput::make('description')
                            ->label('Описание')
                            ->nullable(),

                        Checkbox::make('is_free')
                            ->label('Бесплатный контент?')
                            ->default(true),
                    ]),

                Section::make('Музыка')
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
                                    ->label('Файл песни')
                                    ->preserveFilenames()
                                    ->directory('media/audio/songs')
                                    ->enableOpen()
                                    ->required()
                                    ->acceptedFileTypes([
                                        'audio/mpeg',   // MIME-тип для MP3
                                        'audio/wav',    // MIME-тип для WAV
                                        'audio/flac',   // MIME-тип для FLAC
                                    ]),
                            ]),
                    ]),

                Section::make('Тексты песен')
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
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Описание')
                    ->searchable(),

                ToggleColumn::make('is_free')
                    ->label('Бесплатное?')
                    ->alignCenter()
                    ->sortable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSongs::route('/'),
            'create' => Pages\CreateSong::route('/create'),
            'edit' => Pages\EditSong::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $stanses = parent::getEloquentQuery()->has('stanses')->pluck('id');
        return parent::getEloquentQuery()
            ->where('type', 'audio')
            ->whereNotIn('id', $stanses);
    }
}
