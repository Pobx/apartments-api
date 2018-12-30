<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload_file(Request $request)
    {
        $public_path = '/public/attached_files';
        $inputs      = $request->all();
        $path        = $_SERVER['DOCUMENT_ROOT'] . $public_path;
        $link_name   = null;

        if ($request->hasFile('file'))
        {
            $image       = $request->file('file');
            $origin_name = $image->getClientOriginalName();
            $link_name   = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        $file      = new FilesController;
        $link_path = $file->getFiles($link_name, $public_path);

        return response()->json(
            [
                'link_name' => $link_name,
                'link_path' => $link_path,
            ], 200);
    }

    public function upload_image(Request $request)
    {
        $public_path = '/public/images';
        $inputs      = $request->all();
        $path        = $_SERVER['DOCUMENT_ROOT'] . $public_path;
        $link_name   = null;

        if ($request->hasFile('image'))
        {
            $image       = $request->file('image');
            $origin_name = $image->getClientOriginalName();
            $link_name   = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        $image     = new ImagesController;
        $link_path = $image->getImages($link_name, $public_path);

        return response()->json(
            [
                'link_name' => $link_name,
                'link_path' => $link_path,
            ], 200);
    }
}
