<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesGroups extends Model
{
    use HasFactory;

    const LEADER = 'LEADER';
    const ANGGOTA = 'ANGGOTA';
}
