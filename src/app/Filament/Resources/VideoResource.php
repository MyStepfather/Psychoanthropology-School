<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
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

class VideoResource extends Resource
{
    protected static ?string $model = Media::class;
    protected static ?string $modelLabel = 'Видео';
    protected static ?string $pluralModelLabel = 'Видео';
    protected static ?string $navigationIcon = 'heroicon-o-pause';
    protected static ?string $slug = 'videos';
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

                Section::make('Видео')
                    ->schema([
                        Repeater::make('mediaResources')
                            ->label('Видео')
                            ->relationship()
                            ->createItemButtonLabel('Добавить видео')
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
                                    ->label('Файл видео')
                                    ->preserveFilenames()
                                    ->directory('media/video')
                                    ->enableOpen()
                                    ->required()
                                    ->acceptedFileTypes([
                                        'video/mpeg', //MIME-тип для MPEG
                                        'video/mp4', //MIME-тип для MP4
                                        'video/quicktime', //MIME-тип для MOV
                                        'video/x-msvideo', //MIME-тип для AVI
                                        'video/x-flv', //MIME-тип для FLV
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 'video');
    }
}
