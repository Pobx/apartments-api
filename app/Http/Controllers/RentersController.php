<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;

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

    public function create(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'id_card'       => 'required',
            'date_of_birth' => 'required',
            'address'       => 'required',
            'mobile'        => 'required',
            'status'        => 'required',
        ]);

        $inputs = $request->all();
        $result = Renters::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required',
            'last_name'     => 'required',
            'id_card'       => 'required',
            'date_of_birth' => 'required',
            'address'       => 'required',
            'mobile'        => 'required',
            'status'        => 'required',
        ]);

        $inputs = $request->all();
        Renters::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
