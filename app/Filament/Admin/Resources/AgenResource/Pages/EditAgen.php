<?php

namespace App\Filament\Admin\Resources\AgenResource\Pages;

use App\Filament\Admin\Resources\AgenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgen extends EditRecord
{
    protected static string $resource = AgenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
