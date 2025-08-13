<?php

namespace App\Filament\Account\Resources\RekeningResource\Pages;

use App\Filament\Account\Resources\RekeningResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRekening extends CreateRecord
{
    protected static string $resource = RekeningResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Rekening berhasil ditambahkan';
    }
}
