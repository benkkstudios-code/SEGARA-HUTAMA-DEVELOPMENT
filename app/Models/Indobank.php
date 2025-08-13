<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $code
 * @property string $nama
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Indobank whereNama($value)
 * @mixin \Eloquent
 */
class Indobank extends Model
{
    use HasFactory;
}
