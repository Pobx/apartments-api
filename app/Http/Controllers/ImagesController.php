<?php

namespace App\Http\Controllers;

class ImagesController extends Controller
{
    public function getImages($image, $path)
    {
        $dir        = $_SERVER['DOCUMENT_ROOT'] . $path . $image;
        $image_path = '/public/default_images/no-image.png';

        if (file_exists($dir) && $image != null)
        {
            $image_path = '/public/images/' . $image;
        }

        $results = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $image_path;

        return $results;
    }
}
