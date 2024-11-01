<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use App\Models\EventType;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $modelLabel = 'Событие';
    protected static ?string $pluralModelLabel = 'События';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Информация о событии')
                    ->schema([
                        Select::make('event_type_id')
                            ->label('Тип события')
                            ->options(fn (callable $get) => EventType::all()
                                ->pluck('name', 'id')
                            )
                            ->required(),

                        TextInput::make('title')
                            ->label('Заголовок')
                            ->required(),

                        RichEditor::make('text')
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
                            ])
                            ->label('Текст')
                            ->nullable(),
                    ]),

                Section::make('Дата и время')
                    ->schema([
                        DatePicker::make('date_start')
                            ->label('Дата начала')
                            ->required(),

                        DatePicker::make('date_end')
                            ->label('Дата окончания')
                            ->required(),

                        Toggle::make('is_show')
                            ->label('Показывать на главной?')
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

                TextColumn::make('eventType.name')
                    ->label('Тип события')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('text')
                    ->label('Текст')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_start')
                    ->label('Дата начала')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_end')
                    ->label('Дата окончания')
                    ->searchable()
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->sortable(),

                ToggleColumn::make('is_show')
                    ->label('Показывать на главной?')
                    ->alignCenter()
                    ->default('0')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
