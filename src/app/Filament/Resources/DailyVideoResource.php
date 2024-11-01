<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyVideoResource\Pages;
use App\Filament\Resources\DailyVideoResource\RelationManagers;
use App\Models\DailyVideo;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DailyVideoResource extends Resource
{
    protected static ?string $model = DailyVideo::class;
    protected static ?string $modelLabel = 'Ежедневное видео';
    protected static ?string $pluralModelLabel = 'Ежедневные видео';
    protected static ?string $navigationIcon = 'heroicon-o-pause';
    protected static ?string $navigationGroup = 'Медиа';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Информация')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        DatePicker::make('date')
                            ->label('Дата видео')
                            ->required(),

                        TextInput::make('url')
                            ->label('Iframe видео')
                            ->required(),
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

                TextColumn::make('date')
                    ->label('Дата видео')
                    ->searchable()
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
            'index' => Pages\ListDailyVideos::route('/'),
            'create' => Pages\CreateDailyVideo::route('/create'),
            'edit' => Pages\EditDailyVideo::route('/{record}/edit'),
        ];
    }
}
