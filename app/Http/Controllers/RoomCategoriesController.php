<?php

namespace App\Http\Controllers;

use App\Models\RoomCategories;
use Illuminate\Http\Request;

class RoomCategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'status' => 'required',
        ]);

        $inputs = $request->all();
        $result = RoomCategories::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id'     => 'required',
            'name'   => 'required',
            'status' => 'required',
        ]);

        $inputs = $request->all();
        RoomCategories::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
