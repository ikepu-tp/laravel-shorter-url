<?php

namespace ikepu_tp\ShorterUrl\app\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function asset(string $file)
    {
        $link = null;
        $path = null;
        switch ($file) {
            case 'style.css':
                $link = "/assets/css/vendor/ShorterUrl/style.css";
                $path = __DIR__ . "/../../../resources/css/style.css";
                break;
            default:
                abort(404);
        }
        if (!is_null($link)) return redirect($link, 301);
        if (is_null($path)) abort(404);
        return response()->file(
            $path,
            [
                "Content-Type" => Storage::mimeType($path),
            ]
        );
    }
}
