<?php

namespace App\Http\Controllers;

use App\Models\RenterPartners;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RenterPartnersController extends Controller
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

    // public function create(Request $request)
    // {

    //     $inputs = $request->all();

    //     $results = [];

    //     if (is_array($inputs))
    //     {
    //         $this->RuleValidateArray($request);
    //         foreach ($inputs as $key => $value)
    //         {
    //             if ($value['id'] == '0')
    //             {
    //                 $result = RenterPartners::create($value);
    //                 array_push($results, $result);
    //             }
    //         }
    //     }
    //     else
    //     {
    //         $this->RuleValidate($request);
    //         $result = RenterPartners::create($inputs);
    //         array_push($results, $result);
    //     }

    //     return response()->json($results, 201);
    // }

    public function create(Request $request)
    {
        $inputs = $request->all();

        $this->RuleValidate($request);
        $result = RenterPartners::create($inputs);

        return response()->json($results, 201);
    }

    public function partners_by_renters_id($id = null)
    {
        $results = RenterPartners::where(
            [
                ['renters_id', '=', $id],
                ['status', '=', 'active'],
            ]
        )->get();

        return response()->json($results, 200);
    }

    public function remove_partner(Request $request)
    {
        $inputs = $request->all();
        RenterPartners::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        RenterPartners::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'renters_id' => 'required|numeric',
            'first_name' => 'required|string|max:200',
            'last_name'  => 'required|string|max:200',
            'mobile'     => 'required|alpha_num|max:10',
            'status'     => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }

    private function RuleValidateArray($request)
    {
        $this->validate($request, [
            '*.renters_id' => 'required|numeric',
            '*.first_name' => 'required|string|max:200',
            '*.last_name'  => 'required|string|max:200',
            '*.mobile'     => 'required|alpha_num|max:10',
            '*.status'     => [
                'required',
                Rule::in(['active', 'disabled']),
            ],
        ]);
    }
}
