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
 * @property string|null $subtitle
 * @property string|null $content
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages query()
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AboutPages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AboutPages extends Model
{
    use HasFactory;
}
