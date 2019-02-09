<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesMonthlyUsage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilitiesMonthlyUsageController extends Controller
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

        $inputs                      = $request->all();
        $inputs['utility_memo_date'] = date('Y-m-d H:i:s');
        $results                     = UtilitiesMonthlyUsage::create($inputs);

        // return response()->json($results, 201);
        return response()->json($inputs, 201);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        UtilitiesMonthlyUsage::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'room_id'               => 'nullable|numeric',
            'utility_categories_id' => 'nullable|numeric',
            // 'utility_memo_date'     => 'required|date',
            'unit_amount'           => 'required|numeric',
            'price_per_unit'        => 'required|numeric',
            'total_price'           => 'required|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }
}
