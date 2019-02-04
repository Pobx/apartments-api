<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
{
    //

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
        $this->RuleValidate($request);
        $inputs = $request->all();
        $result = Rooms::create($inputs);

        return response()->json($result->id, 201);
    }

    public function find_rooms_by_apartment_id($id)
    {
        $results = Rooms::where([
            ['status', '=', 'active'],
        ])->get();

        return response()->json($results, 200);
    }

    public function index()
    {
        $results = Rooms::with([
            'room_categories:id,name',
            'apartments:id,name',
            'utilities_packages:id,name',
            'renters:id,first_name,last_name',
        ])->get();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        Rooms::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'apartments_id'         => 'nullable|numeric',
            'room_categories_id'    => 'nullable|numeric',
            'price'                 => 'required|alpha_num',
            'status'                => 'required',
            'utilities_packages_id' => 'nullable|numeric',
            'renters_id'            => 'nullable|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled', 'rented_room']),
            ],
        ]);
    }
}
