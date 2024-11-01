<?php

namespace App\Filament\Resources;

use App\Constants\ProductCategories;
use App\Constants\SubscribesTypes;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $modelLabel = 'Продукт';
    protected static ?string $pluralModelLabel = 'Продукты';

    //TODO Непонятно что с order_product

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Название')
                    ->schema([
                        TextInput::make('name')
                            ->label('Название')
                            ->required(),

                        Select::make('category')
                            ->label('Категория')
                            ->options(ProductCategories::ALL_NAMES)
                            ->nullable(),

                        Select::make('code')
                            ->label('Код')
                            ->options(SubscribesTypes::ALL_NAMES)
                            ->nullable(),

                        TextInput::make('price')
                            ->label('Цена')
                            ->numeric()
                            ->required(),

                        Select::make('artist_id')
                            ->label('Автор')
                            ->relationship('artist', 'name')
                            ->nullable(),

                        RichEditor::make('description')
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
                            ->label('Описание')
                            ->nullable(),
                    ]),

                Section::make('Медиа')
                    ->schema([
                        Select::make('media')
                            ->label('Привязать медиа к продукту')
                            ->multiple()
                            ->preload()
                            ->relationship('media', 'name',),

                        FileUpload::make('cover')
                            ->label('Обложка')
                            ->preserveFilenames()
                            ->directory('image/cover')
                            ->enableOpen()
                            ->image()
                            ->maxSize(2048)
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
                    ->label('Название')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Категория')
                    ->getStateUsing(fn ($record) =>
                        $record->category ? ProductCategories::ALL_NAMES[$record->category] : '-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('Код')
                    ->getStateUsing(fn ($record) =>
                        $record->code ? SubscribesTypes::ALL_NAMES[$record->code] : '-')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Цена')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('cover')
                    ->label('Обложка')
                    ->circular(),

                TextColumn::make('artist.name')
                    ->label('Автор')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('media.name')
                    ->label('Медиа')
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
