<?php

namespace App\Libraries;

use App\Libraries\Entities\Distance;
use App\Libraries\Entities\LatLong;

class DistanceCalculator
{

    function getDistanceBetweenLatLang(LatLong $base, LatLong $user): Distance
    {
        $theta = $base->lng() - $user->lng();
        $miles = (sin(deg2rad($base->lat())) * sin(deg2rad($user->lat()))) + (cos(deg2rad($base->lat())) * cos(deg2rad($user->lat())) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        return new Distance($miles);
    }
}
