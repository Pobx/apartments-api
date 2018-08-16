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

    private $validate = [
        'renters_id' => 'required|numeric',
        'first_name' => 'required|string',
        'last_name'  => 'required|string',
        'mobile'     => 'required|numeric|max:10',
        'status'     => 'required',
    ];

    public function create(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = RenterPartners::create($inputs);

        return response()->json($result->id, 201);
    }

    public function remove_partner(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        RenterPartners::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
