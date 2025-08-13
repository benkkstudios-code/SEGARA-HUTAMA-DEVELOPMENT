<?php

namespace App\Filament\Premi\Resources\PremiResource\Pages;

use App\Filament\Premi\Resources\PremiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPremi extends EditRecord
{
    protected static string $resource = PremiResource::class;

    protected function getFormActions(): array
    {
        return [];
    }
    protected function getHeaderActions(): array
    {
        return [];
    }
}