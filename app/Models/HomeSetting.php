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
 * @property string|null $about
 * @property string $content
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HomeSetting extends Model
{
    use HasFactory;
}
