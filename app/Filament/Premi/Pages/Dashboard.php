<?php

namespace App\Filament\Premi\Pages;

use App\Filament\Premi\Widgets\PremiOverview;
use App\Filament\Premi\Widgets\PremiSuccessStats;
use App\Filament\Resources\InvoiceResource;
use App\Filament\Widgets\InvoiceTerbayar;
use App\Filament\Widgets\StatsOverview;
use Filament\Facades\Filament;

class Dashboard extends \Filament\Pages\Dashboard
{

    public function getWidgets(): array
    {
        return [

            // \App\Filament\Widgets\InvoicePending::class,
            // \App\Filament\Widgets\InvoiceTerbayar::class,
            PremiOverview::class,
            PremiSuccessStats::class,
            \App\Filament\Premi\Widgets\PremiSuccess::class,
            \App\Filament\Premi\Widgets\PremiPending::class,
        ];
    }
}
