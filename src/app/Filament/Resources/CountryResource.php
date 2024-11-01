<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;
    protected static ?string $modelLabel = 'Страна';
    protected static ?string $pluralModelLabel = 'Страны';
    protected static ?string $navigationGroup = 'Структура школы';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        Select::make('council_id')
                            ->label('Совет')
                            ->relationship('council', 'name')
                            ->required(),

                        TextInput::make('name')
                            ->label('Страна')
                            ->required(),

                        TextInput::make('order')
                            ->numeric()
                            ->label('Порядок вывода')
                            ->required(),
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

                TextColumn::make('name')
                    ->label('Страна')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('council.name')
                    ->label('Совет')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order')
                    ->label('Порядок вывода')
                    ->sortable(),
            ])
            ->defaultSort('order')
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
