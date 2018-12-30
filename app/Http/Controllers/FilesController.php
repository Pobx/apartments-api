<?php

namespace App\Http\Controllers;

class FilesController extends Controller
{
    public function getFiles($file, $path)
    {
        $dir        = $_SERVER['DOCUMENT_ROOT'] . $path . $file;
        $file_path = '/public/default_images/no-image.png';

        if (file_exists($dir) && $file != null)
        {
            $file_path = $path. $file;
        }

        $results = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $file_path;

        return $results;
    }
}
