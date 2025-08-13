<?php

namespace App\Filament\Account\Resources\PerusahaanResource\Pages;

use App\Filament\Account\Resources\PerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePerusahaan extends CreateRecord
{
    protected static string $resource = PerusahaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Perusahaan berhasil ditambahkan';
    }
}
