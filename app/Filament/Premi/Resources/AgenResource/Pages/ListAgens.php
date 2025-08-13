<?php

namespace App\Filament\Premi\Resources\AgenResource\Pages;

use App\Filament\Premi\Resources\AgenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgens extends ListRecords
{
    protected static string $resource = AgenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
