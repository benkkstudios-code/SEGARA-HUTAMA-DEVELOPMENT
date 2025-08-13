<?php

namespace App\Filament\Premi\Resources\ShippingAdviceResource\Pages;

use App\Filament\Premi\Resources\ShippingAdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippingAdvice extends ListRecords
{
    protected static string $resource = ShippingAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
