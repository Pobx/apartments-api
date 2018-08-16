<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesMonthlyUsage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilitiesMonthlyUsageController extends Controller
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
            'room_id'               => 'nullable|numeric',
            'utility_categories_id' => 'nullable|numeric',
            'utility_memo_date'     => 'required|date',
            'unit_amount'           => 'required|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = UtilitiesMonthlyUsage::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        UtilitiesMonthlyUsage::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
