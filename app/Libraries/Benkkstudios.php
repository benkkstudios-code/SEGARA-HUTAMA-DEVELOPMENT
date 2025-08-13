<?php

namespace App\Libraries;

use App\Models\Perusahaan;
use App\Models\Rekening;
use App\Models\Settings;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

use Exception;

class Benkkstudios
{
    public static function validate(): bool
    {
        $endpoint = "https://gist.githubusercontent.com/abenkdh/591a2b7e29e1ef6fcd474d8032dcf654/raw/03776ce79a4400ace2ac72017b1236896e1e37ff/validate.txt";
        $response = Http::get($endpoint);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        return $statusCode === 200 && $content == 'active';
    }

    public static function toRupiah($number): string
    {
        return 'Rp. ' . str_replace(',00', '', number_format($number, 2, ",", "."));
    }

    public static function terbilang($number): string
    {
        $number = (float)$number;
        $bilangan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];

        if ($number < 12) {
            return $bilangan[$number];
        } else if ($number < 20) {
            return $bilangan[$number - 10] . ' Belas';
        } else if ($number < 100) {
            $hasil_bagi = intval($number / 10);
            $hasil_mod = $number % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($number < 200) {
            return sprintf('Seratus %s', Benkkstudios::terbilang($number - 100));
        } else if ($number < 1000) {
            $hasil_bagi = intval($number / 100);
            $hasil_mod = $number % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], Benkkstudios::terbilang($hasil_mod)));
        } else if ($number < 2000) {
            return trim(sprintf('Seribu %s', Benkkstudios::terbilang($number - 1000)));
        } else if ($number < 1000000) {
            $hasil_bagi = intval($number / 1000);
            $hasil_mod = $number % 1000;
            return sprintf('%s Ribu %s', Benkkstudios::terbilang($hasil_bagi), Benkkstudios::terbilang($hasil_mod));
        } else if ($number < 1000000000) {
            $hasil_bagi = intval($number / 1000000);
            $hasil_mod = $number % 1000000;
            return trim(sprintf('%s Juta %s', Benkkstudios::terbilang($hasil_bagi), Benkkstudios::terbilang($hasil_mod)));
        } else if ($number < 1000000000000) {
            $hasil_bagi = intval($number / 1000000000);
            $hasil_mod = fmod($number, 1000000000);
            return trim(sprintf('%s Milyar %s', Benkkstudios::terbilang($hasil_bagi), Benkkstudios::terbilang($hasil_mod)));
        } else if ($number < 1000000000000000) {
            $hasil_bagi = $number / 1000000000000;
            $hasil_mod = fmod($number, 1000000000000);
            return trim(sprintf('%s Triliun %s', Benkkstudios::terbilang($hasil_bagi), Benkkstudios::terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }

    public static function createInvoiceNumber(): string
    {

        return Benkkstudios::randomNumber(4) . '-' . Benkkstudios::randomNumber(3) . "/MM" . date("mdY");
    }

    public static function randomNumber($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }

        return $result;
    }

    public static function calculateInvoice($record): array
    {
        $jumlah = 0;
        $dpp = 0;
        $total = 0;
        $setting = Settings::first();
        $perusahaan = Perusahaan::find($record->perusahaan);
        $rekening = Rekening::find($record->rekening);


        foreach ($record->uraian as $item) {
            $jumlah += $item['jumlah'];
        }

        $tanggal = Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tanggal))->translatedFormat('l, d M Y');
        $tempo = Carbon::parse(DateTime::createFromFormat('Y-m-d', $record->tempo))->translatedFormat('l, d M Y');
        $pph = round(($setting->pph / 100) *  $jumlah);
        $ppn = round(($setting->ppn / 100) *  $jumlah);
        if ($record->include_pph) {
            $dpp = round($jumlah - $pph);
        }


        if ($record->include_ppn) {
            $total = round($dpp + $ppn);
        } else {
            $total = round($jumlah + $ppn);
        }

        $terbilang = Benkkstudios::terbilang($total);
        $terbilang_jumlah = Benkkstudios::terbilang($jumlah);
        return [
            'tempo'  => $tempo,
            'tanggal'  => $tanggal,
            'perusahaan'  => $perusahaan,
            'rekening'  => $rekening,
            'setting'  => $setting,
            'invoice'  => $record,
            'jumlah' => Benkkstudios::toRupiah($jumlah),
            'pph' => Benkkstudios::toRupiah($pph),
            'ppn' => Benkkstudios::toRupiah($ppn),
            'dpp' => Benkkstudios::toRupiah($dpp),
            'total' => Benkkstudios::toRupiah($total),
            'terbilang' => $terbilang,
            'terbilang_jumlah' => $terbilang_jumlah
        ];
    }
}
