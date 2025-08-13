<?php

namespace App\Filament\Premi\Widgets;

use App\Filament\Account\Resources\InvoiceResource\Pages\EditInvoice;
use App\Libraries\Benkkstudios;
use App\Models\Invoice;
use App\Models\Premis;
use App\Models\SalesGroups;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Carbon\Carbon;
use DateTime;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PremiSuccess extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Premis::query()->where('status', 'Sudah Dibayar')
            )

            ->columns([
                TextColumn::make('nomor')->searchable()->copyable()->copyMessage('Nomor berhasil disalin.'),
                BadgeableColumn::make('user')
                    ->label('SALES')
                    ->getStateUsing(
                        function ($record) {
                            $user = User::find($record->user);

                            return $user->name;
                        }
                    )
                    ->suffixBadges([
                        Badge::make('LEADER')
                            ->label('LEADER')
                            ->color('success')
                            ->visible(fn(Premis $record) => User::find($record->user)->level == SalesGroups::LEADER),
                        Badge::make('ANGGOTA')
                            ->label('ANGGOTA')
                            ->color('warning')
                            ->visible(fn(Premis $record) => User::find($record->user)->level == SalesGroups::ANGGOTA),
                    ]),
                BadgeableColumn::make('group')
                    ->label('GRUP')
                    ->getStateUsing(
                        function ($record) {
                            $group = SalesGroups::find($record->group);

                            return $group->name;
                        }
                    ),
                Tables\Columns\TextColumn::make('tanggal')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tanggal))->translatedFormat('l, d M Y');
                    }
                ),
                Tables\Columns\TextColumn::make('premi')->searchable()->sortable()->getStateUsing(
                    function ($record) {
                        return Benkkstudios::toRupiah($record->premi);
                    }
                ),
            ])
        ;
    }
}
