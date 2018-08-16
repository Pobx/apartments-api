<?php

namespace App\Http\Controllers;

class UploadController extends Controller
{
    public function uploadFile($request, $path = '')
    {

        $inputs = $request->all();
        $path = ($path == '' ? $_SERVER['DOCUMENT_ROOT'] . '/images' : $path);
        $link_name = (!isset($inputs['old_file']) || $inputs['old_file'] == null ? null : $inputs['old_file']);

        if ($request->hasFile('new_file'))
        {
            $image = $request->file('new_file');
            $origin_name = $image->getClientOriginalName();
            $link_name = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        return $link_name;
    }
}
