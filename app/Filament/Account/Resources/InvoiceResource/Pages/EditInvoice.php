<?php

namespace App\Filament\Account\Resources\InvoiceResource\Pages;

use App\Filament\Account\Resources\InvoiceResource;
use App\Models\Settings;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

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

        $setting = Settings::first();
        $pph = round(($setting->pph / 100) *  $jumlah);
        $ppn = round(($setting->ppn / 100) *  $jumlah);
        $dpp = round($jumlah - $pph);
        $data['total'] = round($dpp + $ppn);
        return $data;
    }
}
