<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Support\Carbon;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $modelLabel = 'Новость';
    protected static ?string $pluralModelLabel = 'Новости';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
         return $form
            ->schema([
                Section::make('Автор')
                    ->schema([
                        Select::make('authorId')
                            ->label('Автор')
                            ->preload()
                            ->searchable()
                            ->relationship('user', 'name_first')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                            ->required(),
                    ]),

                Section::make('Новость')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Заголовок'),

                        TextInput::make('description')
                            ->required()
                            ->label('Описание'),

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
                            ->label('Новость')
                            ->nullable(),

                        FileUpload::make('image_url')
                            ->label('Загрузите обложку')
                            ->disk('public')
                            ->directory('image/news')
                            ->image()
                            ->minSize(50)
                            ->maxSize(6020)
                            ->nullable()
                    ]),

                    Section::make('Дополнительно')
                        ->schema([
                            FileUpload::make('video_url')
                                ->label('Загрузите видео')
                                ->disk('public')
                                ->directory('video/news')
                                ->acceptedFileTypes(['video/mp4'])
                                ->minSize(512)
                                ->maxSize(15000)
                                ->nullable(),

                            Toggle::make('is_video_show')
                                ->label('Отобразить на главной странице')
                                ->default('0')
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

                TextColumn::make('user.full_name')
                    ->label('Автор')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('is_show')
                    ->label('Опубликовать')
                    ->default('0')
                    ->sortable()
                    ->updateStateUsing(function ($state, $record) {
                        if ($state) {
                            $record->published_at = now();
                            $record->is_show = '1';
                        } else {
                            $record->published_at = null;
                            $record->is_show = '0';
                        }
                        $record->save();
                    }),

                TextColumn::make('published_at')
                    ->label('Дата публикации')
                    ->placeholder('-')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->locale('ru')->translatedFormat('d F Y'))
                    ->searchable()
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
