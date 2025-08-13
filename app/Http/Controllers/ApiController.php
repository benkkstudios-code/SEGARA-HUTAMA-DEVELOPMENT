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

class ApiController extends Controller
{
    public function color(Request $request)
    {
        $data =  AppColors::first();
        $data['success'] = true;
        $data['message'] = 'success';
        return $this->validateHeader($request, $data);
    }

    public function setting(Request $request)
    {
        $data =  Settings::first();
        $data['success'] = true;
        $data['message'] = 'success';
        return $this->validateHeader($request, $data);
    }

    public function categories(Request $request)
    {
        $data =  Categories::orderBy('id', 'DESC')->get();
        return $this->validateHeader($request, $data);
    }

    public function hashtag(Request $request)
    {
        $data =  Hashtag::orderBy('hashtag', 'ASC')->get();
        return $this->validateHeader($request, $data);
    }

    public function latest(Request $request)
    {
        $data =  Wallpaper::orderBy('id', 'DESC')->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function live(Request $request)
    {
        $data =  Wallpaper::where('type', 'VIDEO')->orWhere('type', 'GIF')->orderBy('id', 'DESC')->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function premium(Request $request)
    {
        $data =   Wallpaper::where('premium', 1)->orderBy('id', 'DESC')->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function free(Request $request)
    {
        $data =   Wallpaper::where('premium', 0)->orderBy('id', 'DESC')->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $data = Wallpaper::where('color', 'like', '%' . $query . '%')
            ->orWhere('hashtag', 'like', '%' . $query . '%')
            ->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function cid(Request $request)
    {
        $cid = $request->get('cid');
        $data =   Wallpaper::where('cid', $cid)->orderBy('id', 'DESC')->paginate(20);
        return $this->validateHeader($request, $data);
    }

    public function plusView(Request $request)
    {
        $id = $request->get('id');
        $wallpaper =   Wallpaper::where('id', $id)->first();
        $view = $wallpaper->view + 1;
        $wallpaper->update(['view' => $view]);
        return $this->validateHeader($request, $wallpaper);
    }

    public function catHash(Request $request)
    {
        $data = [];
        $categories = array();
        $hashtags =  Hashtag::orderBy('hashtag', 'ASC')->get();
        foreach (Categories::orderBy('name', 'ASC')->get() as $cat) {
            $cat['size'] = Wallpaper::where('cid', $cat->id)->count();
            array_push($categories, $cat);
        }
        $data['success'] = true;
        $data['message'] = 'success';
        $data['categories'] = $categories;
        $data['hashtags'] = $hashtags;
        return $this->validateHeader($request, $data);
    }

    public function home(Request $request)
    {
        $setting = Settings::where('id', 1)->first();
        $array = array();

        if ($setting->enable_latest) {
            $wallpapers =  Wallpaper::orderBy('id', 'DESC')->take(20)->get();
            if (sizeof($wallpapers) != 0) {
                array_push($array, ['title' => 'LATEST', 'wallpapers' =>  $wallpapers]);
            }
        }

        if ($setting->enable_live) {
            $wallpapers =  Wallpaper::where('type', 'VIDEO')->orWhere('type', 'GIF')->orderBy('id', 'DESC')->take(20)->get();
            if (sizeof($wallpapers) != 0) {
                array_push($array, ['title' => 'LIVE', 'wallpapers' =>  $wallpapers]);
            }
        }

        if ($setting->enable_random) {
            $wallpapers =  Wallpaper::take(20)->get()->shuffle();
            if (sizeof($wallpapers) != 0) {
                array_push($array, ['title' => 'RANDOM', 'wallpapers' =>  $wallpapers]);
            }
        }

        if ($setting->enable_premium) {
            $wallpapers =  Wallpaper::where('premium', 1)->orderBy('id', 'DESC')->take(20)->get();
            if (sizeof($wallpapers) != 0) {
                array_push($array, ['title' => 'PREMIUM', 'wallpapers' =>  $wallpapers]);
            }
        }

        if ($setting->enable_free) {
            $wallpapers =  Wallpaper::where('premium', 0)->orderBy('id', 'DESC')->take(20)->get();
            if (sizeof($wallpapers) != 0) {
                array_push($array, ['title' => 'FREE', 'wallpapers' =>  $wallpapers]);
            }
        }

        $data = [
            'success' => true,
            'message' => 'Server response success',
            'sliders' => Wallpaper::orderBy('view', 'DESC')->take(20)->get(),
            'colors' => Color::orderBy('id', 'DESC')->get(),
            'homes' => $array
        ];

        return $this->validateHeader($request, $data);
    }

    public function validateHeader(Request $request, $data)
    {
        $key = $request->header('Server-Key');
        $package = $request->header('Package-Name');
        $setting = Settings::where('id', 1)->first();
        if ($setting->server_key !== $key) {
            return Response::json([
                'success' => false,
                'message' => 'Server Key not valid'
            ], 200);
        }

        if ($setting->package_name !== $package) {
            return Response::json([
                'success' => false,
                'message' => 'Package Name not valid'
            ], 200);
        }

        return Response::json($data, 200);
    }
}
