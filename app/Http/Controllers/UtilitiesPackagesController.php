<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesPackages;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilitiesPackagesController extends Controller
{
    //

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
        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = UtilitiesPackages::create($inputs);

        return response()->json($result->id, 201);
    }

    public function index()
    {
        $results = UtilitiesPackages::with([
            'utilities_package_items.utilities_items' => function ($query)
            {
                $query->where('status', '=', 'active');
            },
        ])->get();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        UtilitiesPackages::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'   => 'required|string',
            'status' => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }
}
