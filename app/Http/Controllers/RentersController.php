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

    private $dateController = null;

    private $filesController = null;

    private $imagesController = null;

    public function __construct()
    {
        $this->dateController   = new DatesController;
        $this->imagesController = new ImagesController;
        $this->filesController  = new FilesController;
    }

    public function create(Request $request)
    {
        $request->merge([
            'date_of_birth' => $this->dateController->setDateEn($request->date_of_birth),
        ]);

        $this->RuleValidate($request);

        $inputs = $request->all();
        $result = Renters::create($inputs);

        return response()->json($request, 201);
    }

    public function find($id)
    {
        $results = Renters::with(['attached_files' => function ($query)
        {
            $query->where('status', '=', 'active');
        }])->find($id);

        if (!empty($results))
        {
            $results['image_path'] = $this->imagesController->getImages($results['attached_file_image'], '/public/images/');

            $results['attached_name'] = $results['attached_files']['attached_name'] ?? null;

            $results['file_path'] = $this->filesController->getFiles($results['attached_name'], '/public/attached_files/');

            $results['date_of_birth'] = date('d/m/Y', strtotime("{$results['date_of_birth']} +543 year"));
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
        $request->merge([
            'date_of_birth' => $this->dateController->setDateEn($request->date_of_birth),
        ]);

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
