<?php

namespace App\Http\Controllers;

use App\Models\Apartments;
use Illuminate\Http\Request;

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

    private $validate = [
        'name'   => 'required',
        'status' => 'required',
    ];

    public function create(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = Apartments::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        Apartments::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
