<?php

namespace App\Filament\Account\Resources\DebitNoteResource\Pages;

use App\Filament\Account\Resources\DebitNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDebitNotes extends ListRecords
{
    protected static string $resource = DebitNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
