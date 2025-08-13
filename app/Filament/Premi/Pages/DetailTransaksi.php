<?php

namespace App\Filament\Premi\Pages;

use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;

class DetailTransaksi extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.premi.pages.detail-transaksi';

    public function mount(string $number): void {}
}
