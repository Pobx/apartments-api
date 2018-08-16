<?php

namespace App\Http\Controllers;

use App\Models\UtilityCategories;
use Illuminate\Http\Request;

class UtilityCategoriesController extends Controller
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

    private $validate = [
        'name'                => 'required|string',
        'price_per_unit_cost' => 'required|numeric',
        'price_per_unit'      => 'required|numeric',
        'unit_min_rate'       => 'required|numeric',
        'unit_min_price'      => 'required|numeric',
        'type'                => 'required',
        'status'              => 'required',
    ];

    public function create(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = UtilityCategories::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        UtilityCategories::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
