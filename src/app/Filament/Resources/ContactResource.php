<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

   
    public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Repeater::make('topics')
                        ->label('Темы')
                        ->schema([
                            TextInput::make('topics')
                                ->label('Темы')
                                ->required(),
                        ])
                        ->columns(1)
                        ->minItems(1)
                        ->createItemButtonLabel('Добавить тему'),
                        Repeater::make('representatives')
                        ->label('Представители')
                        ->schema([
                            TextInput::make('representatives')
                                ->label('Представитель')
                                ->required(),
                        ])
                        ->columns(2)
                        ->minItems(1)
                        ->createItemButtonLabel('Добавить Представителя'),
                    
                ]);
        }



    
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TagsColumn::make('topics')
                ->label('Темы')
                ->getStateUsing(fn ($record) => collect($record->topics)->pluck('topics')->toArray()), // Преобразуем объекты в строки
            TagsColumn::make('representatives')
                ->label('Представители')
                ->getStateUsing(fn ($record) => collect($record->representatives)->pluck('representatives')->toArray()), // Преобразуем объекты в строки

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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }    
}
