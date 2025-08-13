<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $bank
 * @property string|null $cabang
 * @property string $nomor
 * @property string $pemilik
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereCabang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereNomor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening wherePemilik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rekening whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rekening extends Model
{
    use HasFactory;
}
