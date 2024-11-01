<?php

namespace App\Filament\Resources;

use App\Constants\ContentTypes;
use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\Content;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;
    protected static ?string $modelLabel = 'Контент';
    protected static ?string $pluralModelLabel = 'Контент';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        Select::make('type')
                            ->label('Вид контента')
                            ->options(ContentTypes::ALL_NAMES)
                            ->required(),

                        TextInput::make('number')
                            ->label('Номер документа')
                            ->numeric()
                            ->maxValue(10000)
                            ->nullable(),

                        TextInput::make('description')
                            ->label('Описание')
                            ->nullable(),

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

                Section::make('Загрузка')
                    ->schema([
                        DatePicker::make('date')
                            ->label('Дата')
                            ->nullable(),

                        Toggle::make('is_publish')
                            ->label('Опубликована?')
                            ->default(1),

                        FileUpload::make('url')
                            ->label('Ссылка на документ')
                            ->preserveFilenames()
                            ->directory('content/bulletin')
                            ->enableOpen()
                            ->nullable()
                            ->acceptedFileTypes([
                                'application/pdf',   // MIME-тип для PDF
                                'text/plain',    // MIME-тип для TXT
                                'application/msword',   // MIME-тип для DOC
                            ]),
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
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Вид контента')
                    ->getStateUsing(fn ($record) =>
                    $record->type ? ContentTypes::ALL_NAMES[$record->type] : '-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('number')
                    ->label('Номер документа')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Дата')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('is_publish')
                    ->label('Опубликована?')
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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
