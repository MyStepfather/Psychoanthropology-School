<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TownResource\Pages;
use App\Filament\Resources\TownResource\RelationManagers;
use App\Models\Country;
use App\Models\Town;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class TownResource extends Resource
{
    protected static ?string $model = Town::class;
    protected static ?string $modelLabel = 'Город';
    protected static ?string $pluralModelLabel = 'Города';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Структура школы';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        Select::make('council_id')
                            ->label('Совет')
                            ->relationship('council', 'name')
                            ->reactive()
                            ->required(),

                Select::make('country_id')
                    ->label('Страна')
                    ->options(
                        fn (callable $get) => Country::query()
                            ->where('council_id', $get('council_id'))
                            ->pluck('name', 'id')
                    )
                    ->required(),

                TextInput::make('name')
                    ->label('Город')
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
                    ->label('Город')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country.name')
                    ->label('Страна')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('council.name')
                    ->label('Совет')
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
            'index' => Pages\ListTowns::route('/'),
            'create' => Pages\CreateTown::route('/create'),
            'edit' => Pages\EditTown::route('/{record}/edit'),
        ];
    }
}
