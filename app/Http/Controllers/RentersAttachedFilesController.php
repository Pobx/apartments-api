<?php

namespace App\Http\Controllers;

use App\Models\RentersAttachedFiles;
use Illuminate\Http\Request;

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

    private function validateRenters($request)
    {
        $this->validate($request, [
            'renters_id'    => 'required',
            'attached_name' => 'required',
            'status'        => 'required',
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
        $this->validateRenters($request);

        $inputs = $request->all();
        $inputs['attached_name'] = $this->setFile($request);
        $result = RentersAttachedFiles::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validateRenters($request);

        $inputs = $request->all();
        $inputs['attached_name'] = $this->setFile($request);
        RentersAttachedFiles::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
