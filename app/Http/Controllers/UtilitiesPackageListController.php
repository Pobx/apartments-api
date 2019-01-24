<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesPackageList;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UtilitiesPackageListController extends Controller
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
        $result = UtilitiesPackageList::create($inputs);

        return response()->json($result->id, 201);
    }

    public function find_by_packages_id($id = null)
    {
        $results = UtilitiesPackageList::where(
            [
                ['utilities_packages_id', '=', $id],
                ['status', '=', 'active'],
            ]
        )->get();

        return response()->json($results, 200);
    }

    public function index()
    {
        $results = UtilitiesPackageList::all();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        UtilitiesPackageList::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'utilities_packages_id' => 'nullable|numeric',
            'utility_categories_id' => 'nullable|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }
}
