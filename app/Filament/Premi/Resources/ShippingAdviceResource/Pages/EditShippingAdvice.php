<?php

namespace App\Filament\Premi\Resources\ShippingAdviceResource\Pages;

use App\Filament\Premi\Resources\ShippingAdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingAdvice extends EditRecord
{
    protected static string $resource = ShippingAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
