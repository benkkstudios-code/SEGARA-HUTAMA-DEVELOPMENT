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
 * @property string|null $transportasi
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
 * @property bool $include_pph
 * @property bool $include_ppn
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereIncludePph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereIncludePpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereLokasiMuat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePengirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePerusahaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePib($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice wherePpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTonase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTransportasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUraian($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    use HasFactory;


    protected $casts = [
        'uraian' => 'array',
        'include_pph' => 'boolean',
        'include_ppn' => 'boolean',
    ];
}
