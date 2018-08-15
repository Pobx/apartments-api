<?php

namespace App\Http\Controllers;

class RoomCategoriesController extends Controller
{
    public function setImage($request, $path)
    {
        // $link_name = 'default.png';
        $inputs = $request->all();
        $link_name = ($inputs['old_image'] == '0' ? 'default.png' : $inputs['old_image']);

        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $origin_name = $image->getClientOriginalName();
            $link_name = date('YmdHis') . '_' . uniqid() . '_' . $origin_name;

            $image->move($path, $link_name);
        }

        return $link_name;
    }
}
