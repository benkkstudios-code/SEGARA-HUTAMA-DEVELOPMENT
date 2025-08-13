<?php

namespace App\Http\Controllers;

use App\Config\constants;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\AboutPages;
use App\Models\AppColors;
use App\Models\Buletins;
use App\Models\Carousel;
use App\Models\Carousels;
use App\Models\Categories;
use App\Models\Color;
use App\Models\Direksis;
use App\Models\Hashtag;
use App\Models\HomeSetting;
use App\Models\Kantors;
use App\Models\Kelebihan;
use App\Models\Kelebihans;
use App\Models\Kontak;
use App\Models\Legalitaz;
use App\Models\Penghargaans;
use App\Models\Perkenalans;
use App\Models\Project;
use App\Models\Punggawas;
use App\Models\ServicesPages;
use App\Models\Settings;
use App\Models\Testimonis;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    // routes/web.php:27
    public function index()
    {
        $data = [
            'menu' => constants::createMenu(),
            'about' => AboutPages::first(),
            'services' => ServicesPages::first(),
            'carousel' => Carousels::first(),
            'kelebihan' => Kelebihans::first(),
            'project' => Project::first(),
            'kontak' => Kontak::first(),
            'direksi' => Direksis::first(),
        ];
        return View::make('home')->with('data', $data);
    }

    // routes/web.php:28
    public function buletin()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'buletin' => Buletins::first(),
        ];
        return View::make('bulletin')->with('data', $data);
    }

    public function penghargaan()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'penghargaan' => Penghargaans::first(),
        ];
        return View::make('penghargaan')->with('data', $data);
    }

    public function punggawa()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'punggawa' => Punggawas::first(),
        ];
        return View::make('punggawa')->with('data', $data);
    }


    public function direksi()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'punggawa' => Punggawas::first(),
            'direksi' => Direksis::first(),
        ];
        return View::make('direksi')->with('data', $data);
    }

    public function perkenalan()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'perkenalan' => Perkenalans::first(),
        ];
        return View::make('perkenalan')->with('data', $data);
    }

    public function kantor()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'kantor' => Kantors::first(),
        ];
        return View::make('kantor')->with('data', $data);
    }

    public function legalitas()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'legalitas' => Legalitaz::first(),
        ];
        return View::make('legalitas')->with('data', $data);
    }


    public function testi()
    {
        $data = [
            'menu' => constants::createMenu(),
            'kontak' => Kontak::first(),
            'testi' => Testimonis::first(),
        ];
        return View::make('testi')->with('data', $data);
    }
}
