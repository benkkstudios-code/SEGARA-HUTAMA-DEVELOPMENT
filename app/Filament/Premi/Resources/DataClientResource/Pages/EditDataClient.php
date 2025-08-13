<?php

namespace App\Filament\Premi\Resources\DataClientResource\Pages;

use App\Filament\Premi\Resources\DataClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataClient extends EditRecord
{
    protected static string $resource = DataClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
