<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RenterPartners;

class RentersController extends Controller
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

        $inputs                        = $request->all();
        $inputs['attached_file_image'] = $this->setFile($request);
        $result                        = Renters::create($inputs);

        return response()->json($result, 201);
    }

    public function find($id)
    {
        $results = Renters::find($id);

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
        $partners = $inputs['partners']?? [];
        unset($inputs['partners']);

        $inputs['attached_file_image'] = $this->setFile($request);
        Renters::updateOrCreate(['id' => $inputs['id']], $inputs);

        foreach ($partners as $key => $value) {
          if ($value['id'] != '0') {
            // $partner = [

            // ];

            // RenterPartners::create($partner);
          }
        }

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

    private function setFile($request)
    {
        $upload = new UploadController;
        $path   = $_SERVER['DOCUMENT_ROOT'] . '/public/images';

        return $upload->uploadFile($request, $path);
    }
}
