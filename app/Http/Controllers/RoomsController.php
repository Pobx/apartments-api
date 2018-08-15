<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
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

    private function validateRooms($request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'apartments_id'         => 'nullable',
            'room_categories_id'    => 'nullable',
            'price'                 => 'required',
            'status'                => 'required',
            'utilities_packages_id' => 'nullable',
            'renters_id'            => 'nullable',
        ]);

    }

    public function create(Request $request)
    {
        $this->validateRooms($request);

        $inputs = $request->all();
        $result = Rooms::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validateRooms($request);

        $inputs = $request->all();
        Rooms::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
