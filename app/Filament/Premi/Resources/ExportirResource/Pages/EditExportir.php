<?php

namespace App\Filament\Premi\Resources\ExportirResource\Pages;

use App\Filament\Premi\Resources\ExportirResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExportir extends EditRecord
{
    protected static string $resource = ExportirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
