<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentersController extends Controller
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

    private function validateRenters($request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'id_card'       => [
                'required',
                'max:13',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'date_of_birth' => 'required',
            'address'       => 'required',
            'mobile'        => [
                'required',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'email'         => [
                'nullable|email',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'status'        => 'required',
        ]);

    }

    public function create(Request $request)
    {
        $this->validateRenters($request);
        $inputs = $request->all();
        $result = Renters::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validateRenters($request);

        $inputs = $request->all();
        Renters::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
