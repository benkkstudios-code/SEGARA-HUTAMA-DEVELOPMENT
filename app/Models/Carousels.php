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
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carousels whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Carousels extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array'
    ];
}
