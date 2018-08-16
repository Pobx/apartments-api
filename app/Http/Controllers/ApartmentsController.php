<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApartmentsController extends Controller
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
            'name'   => 'required',
            'status' => Rule::in(['new_apartment', 'active_apartment', 'disabled_apartment', 'maintennace_apartment']),
        ]);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = Apartments::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        Apartments::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
