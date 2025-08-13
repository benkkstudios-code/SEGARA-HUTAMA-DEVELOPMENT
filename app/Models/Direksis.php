<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direksis extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'array',

    ];
}
