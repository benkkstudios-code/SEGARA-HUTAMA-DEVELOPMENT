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
 * @property array|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelebihans whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kelebihans extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array'
    ];
}
