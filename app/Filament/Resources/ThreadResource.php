<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThreadResource\Pages;
use App\Models\Thread;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ThreadResource extends Resource
{
    protected static ?string $model = Thread::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('content')
                    ->required(),

                Forms\Components\Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->required(),

                Forms\Components\Placeholder::make('author')
                    ->label('Author')
                    ->content(function ($record) {
                        if (! $record || ! $record->user) {
                            return '-';
                        }

                        return $record->user->name . ' (' . $record->user->email . ')';
                    }),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Thread Details')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title')
                            ->size(TextEntry\TextEntrySize::Large),

                        TextEntry::make('content')
                            ->label('Content')
                            ->columnSpanFull()
                            ->prose(),

                        TextEntry::make('subject.name')
                            ->label('Subject'),

                        TextEntry::make('is_anonymous')
                            ->label('Anonymous')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                    ])
                    ->columns(2),

                Section::make('Author Information')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Author Name'),

                        TextEntry::make('user.email')
                            ->label('Author Email'),
                    ])
                    ->columns(2),

                Section::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Author Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListThreads::route('/'),
            'view' => Pages\ViewThread::route('/{record}'),
        ];
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
