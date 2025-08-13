<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perusahaan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Perusahaan extends Model
{
    use HasFactory;
}
