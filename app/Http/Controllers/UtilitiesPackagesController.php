<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesPackages;
use Illuminate\Http\Request;

class UtilitiesPackagesController extends Controller
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
        'name'   => 'required|string',
        'status' => 'required',
    ];

    public function create(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = UtilitiesPackages::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        UtilitiesPackages::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
