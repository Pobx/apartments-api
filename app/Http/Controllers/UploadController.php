<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadFile($request, $path = '')
    {

        $inputs    = $request->all();
        $path      = ($path == '' ? $_SERVER['DOCUMENT_ROOT'] . '/images' : $path);
        $link_name = (!isset($inputs['old_file']) || $inputs['old_file'] == null ? null : $inputs['old_file']);

        if ($request->hasFile('new_file'))
        {
            $image       = $request->file('new_file');
            $origin_name = $image->getClientOriginalName();
            $link_name   = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        return $link_name;
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
