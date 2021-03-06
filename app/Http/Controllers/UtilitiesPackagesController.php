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
            'utilities_package_items'                 => function ($query)
            {
                $query->select('id', 'utilities_packages_id', 'utility_categories_id');
                $query->where('status', '=', 'active');
            },
            'utilities_package_items.utilities_items' => function ($query)
            {
                $query->select('id', 'name');
                $query->where('status', '=', 'active');
            },
        ])->get(['utilities_packages.id', 'utilities_packages.name', 'utilities_packages.status']);

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
