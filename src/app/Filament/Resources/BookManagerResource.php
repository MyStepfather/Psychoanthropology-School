<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookManagerResource\Pages;
use App\Filament\Resources\BookManagerResource\RelationManagers;
use App\Models\BookManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class BookManagerResource extends Resource
{
    protected static ?string $model = BookManager::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $modelLabel = 'Менеджера книг';
    protected static ?string $pluralModelLabel = 'Менеджеры книг';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Название региона/города')
                    ->required(),
                Select::make('user_id')
                    ->label('Имя ответственного')
                    ->preload()
                    ->relationship('user', 'name_first')
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.full_name')
                    ->label('Имя ответственного')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Название региона/города')
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('id')

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
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
            'index' => Pages\ListBookManagers::route('/'),
            'create' => Pages\CreateBookManager::route('/create'),
            'view' => Pages\ViewBookManager::route('/{record}'),
            'edit' => Pages\EditBookManager::route('/{record}/edit'),
        ];
    }
}
