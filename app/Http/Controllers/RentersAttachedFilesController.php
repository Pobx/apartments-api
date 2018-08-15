<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;

class RentersController extends Controller
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
        $upload = new UploadController;
        return $upload->uploadFile($request);
    }

    public function create(Request $request)
    {
        $this->validateRenters($request);

        $inputs = $request->all();
        $inputs['attached_file_image'] = $this->setFile($request);
        $result = Renters::create($inputs);

        return response()->json($result->id, 201);
    }

    public function update(Request $request)
    {
        $this->validateRenters($request);

        $inputs = $request->all();
        $inputs['attached_file_image'] = $this->setFile($request);
        Renters::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    //
}
