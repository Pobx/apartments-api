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

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'apartments_id'         => 'nullable|numeric',
            'room_categories_id'    => 'nullable|numeric',
            'price'                 => 'required|numeric',
            'status'                => 'required',
            'utilities_packages_id' => 'nullable|numeric',
            'renters_id'            => 'nullable|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled', 'rented_room']),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);
        $inputs = $request->all();
        $result = Rooms::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        Rooms::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
