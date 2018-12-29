<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RentersController extends Controller
{
    // private function setFile($request)
    // {
    //     $upload = new UploadController;
    //     $path   = $_SERVER['DOCUMENT_ROOT'] . '/public/images';
    //     return $upload->uploadFile($request, $path);
    // }

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

        $inputs                        = $request->all();
        $inputs['attached_file_image'] = $this->setFile($request);
        $result                        = Renters::create($inputs);

        return response()->json($result, 201);
    }

    public function find($id)
    {
        $results = Renters::find($id);

        if (!empty($results))
        {
            $path       = $_SERVER['DOCUMENT_ROOT'] . '/public/images/' . $results['attached_file_image'];
            $image_path = '/public/default_images/no-image.png';

            if (file_exists($path) && $results['attached_file_image'] != null)
            {
                $image_path = '/public/images/' . $results['attached_file_image'];
            }

            $results['image_path'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $image_path;

        }

        return response()->json($results, 200);
    }

    public function index()
    {
        $results = Renters::with([
            'rooms:id,name,renters_id',
        ])->get();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        // $inputs['attached_file_image'] = $this->setFile($request);
        Renters::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'id_card'       => [
                'required',
                'alpha_num',
                'max:13',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'date_of_birth' => 'required|date',
            'address'       => 'required',
            'mobile'        => [
                'required',
                'alpha_num',
                'max:10',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'email'         => [
                'nullable',
                Rule::unique('renters')->ignore($request->input('id')),
            ],
            'status'        => 'required',
        ]);

    }
}
