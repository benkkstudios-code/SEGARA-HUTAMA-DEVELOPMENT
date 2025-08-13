<?php

namespace App\Filament\Account\Resources\RekeningResource\Pages;

use App\Filament\Account\Resources\RekeningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekenings extends ListRecords
{
    protected static string $resource = RekeningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
