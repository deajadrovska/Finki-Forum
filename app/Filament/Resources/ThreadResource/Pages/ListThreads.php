<?php

namespace App\Filament\Resources\ThreadResource\Pages;

use App\Filament\Resources\ThreadResource;
use Closure;
use Filament\Resources\Pages\ListRecords;

class ListThreads extends ListRecords
{
    protected static string $resource = ThreadResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getTableRecordUrlUsing(): Closure
    {
        return fn ($record) => static::getResource()::getUrl('view', ['record' => $record]);
    }
}
