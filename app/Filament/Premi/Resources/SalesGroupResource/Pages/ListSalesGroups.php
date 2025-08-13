<?php

namespace App\Filament\Premi\Resources\SalesGroupResource\Pages;

use App\Filament\Premi\Resources\SalesGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesGroups extends ListRecords
{
    protected static string $resource = SalesGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
