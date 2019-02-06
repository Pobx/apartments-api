<?php

namespace App\Http\Controllers;

use App\Models\UtilityCategories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilityCategoriesController extends Controller
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
        $result = UtilityCategories::create($inputs);

        return response()->json($result->id, 201);
    }

    public function find($id = null)
    {
        $results = UtilityCategories::find($id);

        return response()->json($results, 200);
    }

    public function index()
    {
        $results = UtilityCategories::all();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        UtilityCategories::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'                => 'required|string',
            'price_per_unit_cost' => 'required|numeric',
            'price_per_unit'      => 'required|numeric',
            'unit_min_rate'       => 'required|numeric',
            'unit_min_price'      => 'required|numeric',
            'type'                => [
                'required',
                Rule::in(['unit', 'monthly']),
            ],
            'status'              => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }
}
