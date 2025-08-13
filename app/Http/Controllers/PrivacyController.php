<?php

namespace App\Http\Controllers;

use App\Models\AppColors;
use App\Models\Categories;
use App\Models\Color;
use App\Models\Hashtag;
use App\Models\Settings;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class PrivacyController extends Controller
{
    public function privacy()
    {
        $setting = Settings::first();
        return View::make('privacy.privacy')->with('setting', $setting);
    }

    public function term()
    {
        $setting = Settings::first();
        return View::make('privacy.term')->with('setting', $setting);
    }
}
