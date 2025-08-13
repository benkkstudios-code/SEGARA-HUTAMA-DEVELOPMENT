<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $alamat
 * @property array|null $email
 * @property array|null $phone
 * @property string|null $facebook
 * @property string|null $twiter
 * @property string|null $linkedin
 * @property string|null $instagram
 * @property string|null $map
 * @property string|null $nama
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereTwiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kontak whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kontak extends Model
{
    use HasFactory;

    protected $casts = [
        'email' => 'array',
        'phone' => 'array'
    ];
}
