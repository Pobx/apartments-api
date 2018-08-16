<?php

namespace App\Http\Controllers;

use App\Models\RenterPartners;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RenterPartnersController extends Controller
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
            'renters_id' => 'required|numeric',
            'first_name' => 'required|string|max:200',
            'last_name'  => 'required|string|max:200',
            'mobile'     => 'required|numeric|max:10',
            'status'     => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = RenterPartners::create($inputs);

        return response()->json($result->id, 201);
    }

    public function remove_partner(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        RenterPartners::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
