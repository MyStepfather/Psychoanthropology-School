<?php

namespace App\Filament\Resources;

use App\Constants\GroupTypes;
use App\Filament\Resources\UserResource\Pages;
use App\Models\Country;
use App\Models\Group;
use App\Models\Town;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Carbon;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Ученик';
    protected static ?string $pluralModelLabel = 'Ученики';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Структура школы';

    //TODO социальные сети

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('login')
                    ->label('Логин')
                    ->required(),

                TextInput::make('name_first')
                    ->label('Имя')
                    ->required(),

                TextInput::make('name_last')
                    ->label('Фамилия')
                    ->required(),

                TextInput::make('name_middle')
                    ->label('Отчество')
                    ->nullable(),

                TextInput::make('phone')
                    ->label('Номер телефона')
                    ->tel()
                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('+{7}(000)000-00-00'))
                    ->nullable(),

                TextInput::make('password')
                    ->label('Пароль')
                    ->required()
                    ->password()
                    ->minLength(6)
                    ->autocomplete('new-password')
                    ->visibleOn('create'),

                TextInput::make('new_password')
                    ->label('Новый пароль')
                    ->password()
                    ->minLength(6)
                    ->nullable()
                    ->visibleOn('edit'),

                TextInput::make('email')
                    ->required(),

                DatePicker::make('entered_at')
                    ->label('Дата поступления в школу')
                    ->nullable(),

                DatePicker::make('birthdate')
                    ->label('Дата рождения')
                    ->nullable(),

                Select::make('roles.id')
                    ->label('Роли')
                    ->multiple()
                    ->relationship('roles', 'display_name')
                    ->preload()
                    ->required(),

                FileUpload::make('avatar')
                    ->label('Аватар')
                    ->preserveFilenames()
                    ->directory('image/avatars')
                    ->enableOpen()
                    ->image()
                    ->maxSize(2048)
                    ->nullable(),

                Section::make('Определите ученика в группу')
                    ->schema([
                        Select::make('group_country_id')
                            ->label('Страна')
                            ->options(fn (callable $get) => Country::all()
                                ->pluck('name', 'id')
                            )
                            ->reactive()
                            ->required(),

                        Select::make('group_town_id')
                            ->label('Город')
                            ->options(fn (callable $get) => Town::query()
                                ->where('country_id', $get('group_country_id'))
                                ->pluck('name', 'id')
                            )
                            ->reactive()
                            ->required(),


                        Select::make('group_id')
                            ->label('Координатор')
                            ->preload()
                            ->options(fn (callable $get) => Group::query()
                                ->where('country_id', $get('group_country_id'))
                                ->where('town_id', $get('group_town_id'))
                                ->get()
                                ->map(function (Group $group) {
                                    $user = User::find($group->coordinator_user_id);
                                    $group->label = GroupTypes::ALL_NAMES[$group->type].' / '.$user->full_name;
                                    return $group;
                                })
                                ->pluck('label', 'id')
                            )
                            ->required(),
                    ]),

                Card::make([
                    Toggle::make('is_active')
                        ->label('Активный пользователь')
                        ->default(0),

                    Toggle::make('is_public')
                        ->label('Данные видны другим')
                        ->default(0),
                ]),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                TextColumn::make('login')
                    ->label('Логин')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name_first')
                    ->label('Имя')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name_last')
                    ->label('Фамилия')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name_middle')
                    ->label('Отчество')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('group.type')
                    ->label('Тип группы')
                    ->getStateUsing(fn($record) =>
                        optional($record->group)->type ? GroupTypes::ALL_NAMES[$record->group->type] : '-'
                    )
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable(),

                ImageColumn::make('avatar')
                    ->circular(),

                TextColumn::make('birthdate')
                    ->label('Дата рождения')
                    ->placeholder('-')
                    ->formatStateUsing(fn($state) => strlen($state) > 1 ? Carbon::parse($state)->locale('ru')->translatedFormat('d F Y') : $state)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('entered_at')
                    ->label('Дата поступления')
                    ->searchable()
                    ->placeholder('-')
                    ->formatStateUsing(fn($state) => strlen($state) > 1 ? Carbon::parse($state)->locale('ru')->translatedFormat('d F Y') : $state)
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Активный пользователь')
                    ->alignCenter()
                    ->sortable(),

                ToggleColumn::make('is_public')
                    ->label('Данные видны другим')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
