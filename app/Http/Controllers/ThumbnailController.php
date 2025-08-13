<?php

namespace App\Http\Controllers;

use App\Libraries\ThumbnailCreator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ThumbnailController extends Controller
{
    public function create(Request $request)
    {
        $url = $request->get('url');
        $size = $request->get('size');
        $path = parse_url($url, PHP_URL_PATH);
        $filename = basename($path);
        $folder = public_path('thumb/' . $size);
        $savePath = $folder . '/' . $filename;
        if (!file_exists($folder)) {
            mkdir($folder);
            chmod($folder, 0777);
        }
        if (!file_exists($folder . $filename)) {
            $image = new ThumbnailCreator();
            $image->load($url);
            $image->resizeToWidth($size);
            $image->save($savePath);
        }
        return response()->file($savePath, ['Content-type' => 'image/jpeg']);
    }
}
