<?php

namespace App\Filament\Account\Resources\PerusahaanResource\Pages;

use App\Filament\Account\Resources\PerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerusahaans extends ListRecords
{
    protected static string $resource = PerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
