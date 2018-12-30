<?php

namespace App\Http\Controllers;

use App\Models\Renters;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function create(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = Renters::create($inputs);

        return response()->json($request, 201);
    }

    public function find($id)
    {
        $results = Renters::find($id);

        if (!empty($results))
        {
            $image                 = new ImagesController;
            $results['image_path'] = $image->getImages($results['attached_file_image'], '/public/images/');
            $results['date_of_birth'] = date( "d/m/Y", strtotime( "{$results['date_of_birth']} +543 year" ));
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
