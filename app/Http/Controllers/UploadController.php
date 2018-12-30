<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload_file(Request $request)
    {
        $inputs    = $request->all();
        $path      = $_SERVER['DOCUMENT_ROOT'] . '/public/files';
        $link_name = null;

        if ($request->hasFile('file'))
        {
            $image       = $request->file('file');
            $origin_name = $image->getClientOriginalName();
            $link_name   = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        $image     = new FilesController;
        $link_path = $image->getFiles($link_name, '/public/files/');

        return response()->json(
            [
                'link_name' => $link_name,
                'link_path' => $link_path,
            ], 200);
    }

    public function upload_image(Request $request)
    {
        $inputs    = $request->all();
        $path      = $_SERVER['DOCUMENT_ROOT'] . '/public/images';
        $link_name = null;

        if ($request->hasFile('image'))
        {
            $image       = $request->file('image');
            $origin_name = $image->getClientOriginalName();
            $link_name   = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        $image     = new ImagesController;
        $link_path = $image->getImages($link_name, '/public/images/');

        return response()->json(
            [
                'link_name' => $link_name,
                'link_path' => $link_path,
            ], 200);
    }
}
