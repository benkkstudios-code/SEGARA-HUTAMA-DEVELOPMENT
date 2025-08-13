<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $perusahaan
 * @property string $nomor
 * @property string $tanggal
 * @property string $transportasi
 * @property string|null $lokasi_muat
 * @property string $pib
 * @property string $pengirim
 * @property int|null $pph
 * @property int $rekening
 * @property int|null $dpp
 * @property int|null $ppn
 * @property string|null $keterangan
 * @property string|null $jumlah
 * @property string|null $total
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $tonase
 * @property string|null $status
 * @property array|null $uraian
 * @property string|null $tempo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereDpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereLokasiMuat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote wherePengirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote wherePerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote wherePib($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote wherePph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote wherePpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereTonase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereTransportasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebitNote whereUraian($value)
 * @mixin \Eloquent
 */
class DebitNote extends Model
{
    use HasFactory;
    protected $casts = [
        'uraian' => 'array'
    ];
}
