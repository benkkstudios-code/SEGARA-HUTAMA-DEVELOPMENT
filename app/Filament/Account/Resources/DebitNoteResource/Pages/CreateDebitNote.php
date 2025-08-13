<?php

namespace App\Filament\Account\Resources\DebitNoteResource\Pages;

use App\Filament\Account\Resources\DebitNoteResource;
use App\Traits\ResourceTrait;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDebitNote extends CreateRecord
{
    use ResourceTrait;

    protected static string $resource = DebitNoteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $jumlah = 0;
        foreach ($data['uraian'] as $item) {
            $jumlah += $item['jumlah'];
        }
        $data['total'] = $jumlah;
        return $data;
    }
}
