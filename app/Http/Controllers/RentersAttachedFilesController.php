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

    private function setFile($request)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/attached_files';
        $upload = new UploadController;
        return $upload->uploadFile($request, $path);
    }

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $inputs['attached_name'] = $this->setFile($request);
        $result = RentersAttachedFiles::create($inputs);

        return response()->json($result->id, 201);
    }

    public function remove_attached_file(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        RentersAttachedFiles::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
