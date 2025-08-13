<?php

namespace App\Filament\Premi\Widgets;

use App\Models\Categories;
use App\Models\Color;
use App\Models\Hashtag;
use App\Models\Invoice;
use App\Models\Premis;
use App\Models\Settings;
use App\Models\Wallpaper;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PremiSuccessStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $start = Carbon::now()->subMonth();

        $end = Carbon::now();

        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();

        return [
            //   Stat::make('Invoice Dibayar', $this->calculate('Sudah Dibayar'))->description('Dari tanggal ' . $start->format('d M Y') . ' sampai ' . $end->format('d M Y'))->color('success'),
            Stat::make('Premi Terbayar', $this->calculate('Sudah Dibayar'))->description('Dari tanggal ' . $start->format('d M Y') . ' sampai ' . $end->format('d M Y'))->color('success'),
        ];
    }

    function calculate($status)
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();
        $invoice = Premis::where("tanggal", ">=", $start)->where('tanggal', "<", $end)->where('status', $status)->orderBy('tanggal')->get();
        $total = $invoice->sum('premi');

        return 'Rp.' . str_replace(',00', '', number_format($total, 2, ",", "."));
    }

    public function convert($value)
    {
        if ($value > 1000) {
            return $value / 1000 . 'k';
        } else {
            return $value;
        }
    }
}
