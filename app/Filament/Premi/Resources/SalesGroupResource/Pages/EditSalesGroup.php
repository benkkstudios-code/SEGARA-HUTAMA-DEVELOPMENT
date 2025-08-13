<?php

namespace App\Filament\Premi\Resources\SalesGroupResource\Pages;

use App\Filament\Premi\Resources\SalesGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesGroup extends EditRecord
{
    protected static string $resource = SalesGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
