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
 * @property string|null $title
 * @property string|null $description
 * @property array|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesPages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServicesPages extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array'
    ];
}
