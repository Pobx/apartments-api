<?php

namespace App\Http\Controllers;

use App\Models\RenterPartners;
use Illuminate\Http\Request;

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

    private function validateRentersPartners($request)
    {
        $this->validate($request, [
            'renters_id' => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'mobile'     => 'required',
        ]);

    }

    public function create(Request $request)
    {
        $this->validateRentersPartners($request);

        $inputs = $request->all();
        $result = RenterPartners::create($inputs);

        return response()->json($result->id, 201);
    }

    public function remove_attached_file(Request $request)
    {
        $this->validateRentersPartners($request);

        $inputs = $request->all();
        RenterPartners::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
