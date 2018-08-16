<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesPackageList;
use Illuminate\Http\Request;

class UtilitiesPackageListController extends Controller
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
        'utilities_packages_id' => 'nullable|numeric',
        'utility_categories_id' => 'nullable|numeric',
        'status'                => 'required',
    ];

    public function create(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        $result = UtilitiesPackageList::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, $this->validate);

        $inputs = $request->all();
        UtilitiesPackageList::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
