<?php

namespace App\Filament\Account\Resources\DebitNoteResource\Pages;

use App\Filament\Account\Resources\DebitNoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDebitNote extends EditRecord
{
    protected static string $resource = DebitNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $jumlah = 0;
        foreach ($data['uraian'] as $item) {
            $jumlah += $item['jumlah'];
        }
        $data['total'] = $jumlah;
        return $data;
    }
}
