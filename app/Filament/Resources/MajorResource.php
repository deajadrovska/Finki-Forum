<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MajorResource\Pages;
use App\Filament\Resources\MajorResource\RelationManagers;
use App\Models\Major;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MajorResource extends Resource
{
    protected static ?string $model = Major::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Shortcut')
                    ->required()
                    ->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
//        return $table
//            ->columns([
//                Tables\Columns\TextColumn::make('name')
//                    ->searchable()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('code')
//                    ->badge()
//                    ->sortable(),
//
//            ]);
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMajors::route('/'),
            'create' => Pages\CreateMajor::route('/create'),
            'edit' => Pages\EditMajor::route('/{record}/edit'),
        ];
    }
}
