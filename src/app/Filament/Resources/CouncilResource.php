<?php

namespace App\Filament\Resources;
use App\Filament\Resources\CouncilResource\Pages;
use App\Filament\Resources\CouncilResource\RelationManagers;
use App\Models\Council;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Models\Student;
use App\Models\Country;
use Filament\Forms\Components\Select;

class CouncilResource extends Resource
{
    protected static ?string $model = Council::class;
    protected static ?string $modelLabel = 'Совет';
    protected static ?string $pluralModelLabel = 'Советы';
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Структура школы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('name')
                            ->label('Совет')
                            ->required(),

                        TextInput::make('order')
                            ->numeric()
                            ->label('Порядок вывода')
                            ->required(),

                        Select::make('representative') // Поле для выбора представителя совета
                            ->label('Представители совета')
                            ->relationship('users', 'full_name') // Указываем связь с моделью пользователей через отношение belongsToMany
                            ->multiple() // Позволяем выбирать нескольких пользователей
                            ->preload() // Предзагрузка опций для улучшения производительности
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->maxItems(20)
                            ->nullable(),
                                        
                        
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
                    ->label('Совет')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order')
                    ->label('Порядок вывода')
                    ->sortable(),

                TextColumn::make('users_count')
                    ->label('Количество представителей')
                    ->counts('users') // Указывает количество связанных пользователей через отношение users
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
            'index' => Pages\ListCouncils::route('/'),
            'create' => Pages\CreateCouncil::route('/create'),
            'edit' => Pages\EditCouncil::route('/{record}/edit'),
        ];
    }
}
