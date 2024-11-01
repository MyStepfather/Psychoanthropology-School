<?php

namespace App\Filament\Resources;

use App\Constants\GroupTypes;
use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use App\Models\Town;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;
    protected static ?string $modelLabel = 'Группа';
    protected static ?string $pluralModelLabel = 'Группы';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Структура школы';

    //TODO вывод помощников только выбранной группы

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Информация')
                    ->schema([
                        Select::make('type')
                            ->label('Тип группы')
                            ->options(GroupTypes::ALL_NAMES)
                            ->reactive()
                            ->required(),

                        Select::make('country_id')
                            ->label('Страна')
                            ->relationship('country', 'name')
                            ->reactive()
                            ->required(),

                        Select::make('town_id')
                            ->label('Город')
                            ->options(
                                fn (callable $get) => Town::query()
                                    ->where('country_id', $get('country_id'))
                                    ->pluck('name', 'id')
                            )
                            ->required(),

                        Select::make('coordinator_user_id')
                            ->label('Координатор')
                            ->relationship('coordinator', 'full_name')
                            ->preload()
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->required(),

                        Select::make('helpers')
                            ->label('Помощники')
                            ->multiple()
                            ->preload()
                            ->relationship('helpers', 'full_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->maxItems(2)
                            ->nullable(),
                    ]),

                Section::make('Время и место')
                    ->schema([
                        Select::make('weekday')
                            ->label('День проведения группы')
                            ->options(GroupTypes::ALL_DAYS)
                            ->nullable(),

                        TimePicker::make('time')
                            ->label('Время проведения группы')
                            ->nullable(),

                        TextInput::make('place')
                            ->label('Место проведения группы')
                            ->nullable(),

                        Toggle::make('is_active')
                            ->label('Активна?')
                            ->default(1),

                        Toggle::make('is_online')
                            ->label('Дистанционная?')
                            ->default(0),
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

                TextColumn::make('type')
                    ->label('Тип')
                    ->getStateUsing(fn ($record) => GroupTypes::ALL_NAMES[$record->type])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country.name')
                    ->label('Страна')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('town.name')
                    ->label('Город')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('coordinator.full_name')
                    ->label('Координатор')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('weekday')
                    ->label('День проведения')
                    ->getStateUsing(fn ($record) => now()
                        ->startOfWeek($record->weekday)
                        ->locale('ru')->isoFormat('dddd')
                    )
                    ->searchable()
                    ->sortable(),

                TextColumn::make('time')
                    ->label('Время проведения')
                    ->sortable(),

                TextColumn::make('helpers.full_name')
                    ->label('Помощники')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Активна?')
                    ->alignCenter()
                    ->sortable(),

                ToggleColumn::make('is_online')
                    ->label('Дистанционная?')
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
