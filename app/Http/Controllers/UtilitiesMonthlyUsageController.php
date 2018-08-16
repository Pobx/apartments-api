<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesMonthlyUsage;
use Illuminate\Http\Request;

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

    private $validate = [
        'name'                  => 'required',
        'room_id'               => 'nullable',
        'utility_categories_id' => 'nullable',
        'utility_memo_date'     => 'required',
        'unit_amount'           => 'required',
        'status'                => 'required',
    ];

    private function validateUtilitiesMonthlyUsageController($request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'room_id'               => 'nullable',
            'utility_categories_id' => 'nullable',
            'utility_memo_date'     => 'required',
            'unit_amount'           => 'required',
            'status'                => 'required',
        ]);

    }

    public function create(Request $request)
    {
        // $this->validateUtilitiesMonthlyUsageController($request);
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = UtilitiesMonthlyUsage::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        // $this->validateUtilitiesMonthlyUsageController($request);
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        UtilitiesMonthlyUsage::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
