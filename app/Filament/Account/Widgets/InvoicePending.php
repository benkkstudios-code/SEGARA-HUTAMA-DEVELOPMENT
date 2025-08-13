<?php

namespace App\Filament\Account\Widgets;

use App\Filament\Account\Resources\InvoiceResource\Pages\EditInvoice;
use App\Models\Invoice;
use Carbon\Carbon;
use DateTime;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InvoicePending extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Invoice::query()->where('status', 'Belum Dibayar')
            )
            ->recordUrl(
                fn(Invoice $record): string => EditInvoice::getUrl([$record->id]),
            )
            ->columns([
                Tables\Columns\TextColumn::make('nomor')->label('#NO')->limit(10)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pib')->label('PIB')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->created_at))->translatedFormat('l, d M Y');
                    }
                ),
                Tables\Columns\TextColumn::make('transportasi')->label('Transport')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lokasi_muat')->label('Lokasi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pengirim')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return 'Rp.' . str_replace(',00', '', number_format($record->total, 2, ",", "."));
                    }
                ),
            ])
        ;
    }
}
