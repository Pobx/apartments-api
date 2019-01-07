<?php

namespace App\Http\Controllers;

use App\Models\RentersAttachedFiles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentersAttachedFilesController extends Controller
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
            'renters_id'    => 'required|numeric',
            'attached_name' => 'required',
            'status'        => Rule::in(['active', 'disabled']),
        ]);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $results = RentersAttachedFiles::create($inputs);

        return response()->json($results, 201);
    }

    public function remove_attached_file(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        RentersAttachedFiles::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    public function update_by_renters_id(Request $request)
    {
      $this->RuleValidate($request);

        $inputs = $request->all();
        RentersAttachedFiles::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
