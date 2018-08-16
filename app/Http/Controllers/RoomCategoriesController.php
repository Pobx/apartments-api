<?php

namespace App\Http\Controllers;

use App\Models\RoomCategories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'   => 'required|string',
            'status' => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $$this->RuleValidate($request);

        $inputs = $request->all();
        $result = RoomCategories::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $$this->RuleValidate($request);

        $inputs = $request->all();
        RoomCategories::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
