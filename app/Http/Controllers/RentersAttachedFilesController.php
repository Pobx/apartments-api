<?php

namespace App\Http\Controllers;

use App\Models\RentersAttachedFiles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentersAttachedFilesController extends Controller
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
        $this->filesController  = new FilesController;
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs  = $request->all();
        $results = RentersAttachedFiles::create($inputs);

        return response()->json($results, 201);
    }

    public function find_by_renters_id($renters_id)
    {
        $results = RentersAttachedFiles::where([
            ['renters_id', '=', $renters_id],
            ['status', '=', 'active'],
        ])->get();

        foreach ($results as $key => $value) {
          $results[$key]['attached_file_path'] = $this->filesController->getFiles($value['attached_name'], '/public/attached_files/');
        }

        return response()->json($results, 200);
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

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'renters_id'    => 'required|numeric',
            'attached_name' => 'required',
            'status'        => Rule::in(['active', 'disabled']),
        ]);
    }
}
