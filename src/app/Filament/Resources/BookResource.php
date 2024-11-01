<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Media;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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

class BookResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $modelLabel = 'Книга';
    protected static ?string $pluralModelLabel = 'Книги';
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $slug = 'books';
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

                Section::make('Книги')
                    ->schema([
                        Repeater::make('mediaResources')
                            ->label('Книги')
                            ->relationship()
                            ->createItemButtonLabel('Добавить книгу')
                            ->schema([
                                Select::make('language_id')
                                    ->label('Язык')
                                    ->relationship('language', 'name')
                                    ->nullable(),
                                Select::make('artist_id')
                                    ->label('Исполнитель')
                                    ->relationship('artist', 'name')
                                    ->nullable(),
                                FileUpload::make('url')
                                    ->label('Файл книги')
                                    ->preserveFilenames()
                                    ->directory('media/books')
                                    ->enableOpen()
                                    ->required()
                                    ->acceptedFileTypes([
                                        'application/pdf',   // MIME-тип для PDF
                                        'text/plain',    // MIME-тип для TXT
                                        'application/msword',   // MIME-тип для DOC
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 'book');
    }
}
