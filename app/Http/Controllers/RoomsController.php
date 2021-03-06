<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\UtilitiesPackageItems;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
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
        $inputs = $request->all();
        $result = Rooms::create($inputs);

        return response()->json($result->id, 201);
    }

    public function find($id)
    {
        $results = Rooms::with([
            'room_categories:id,name',
            'apartments:id,name',
            'utilities_packages:id,name',
            'renters:id,first_name,last_name',
            'utilities_monthly_usage' => function ($query)
            {
                $query->select('utilities_monthly_usage.*', 'utility_categories.name AS utilities_categories_name')
                    ->leftJoin('utility_categories', 'utilities_monthly_usage.utility_categories_id', '=', 'utility_categories.id')
                    ->where('utilities_monthly_usage.status', '=', 'active')->whereYear('utilities_monthly_usage.utility_memo_date', '>=', date('Y') - 1)
                    ->whereYear('utilities_monthly_usage.utility_memo_date', '<=', (date('Y')))
                    ->orderBy('utilities_monthly_usage.id', 'desc');
            },
        ])->find($id);

        foreach ($results['utilities_monthly_usage'] as $key => $value)
        {

            $utility_memo_date_en                                             = strtotime('+543 years', strtotime($value['utility_memo_date']));
            $results['utilities_monthly_usage'][$key]['utility_memo_date_th'] = date('d/m/Y', $utility_memo_date_en);
        }

        return response()->json($results, 200);
    }

    public function find_rooms_by_apartment_id($id)
    {
        $results = Rooms::where([
            ['apartments_id', '=', $id],
            ['status', '=', 'active'],
        ])->get();

        foreach ($results as $key => $value)
        {
            $results[$key]['utilities_packages_items'] = [];
            $utilities_packages_items                  = [];
            $utilities_packages_id                     = $value['utilities_packages_id'] || null;

            if ($utilities_packages_id != null)
            {
                $utilities_packages_items = UtilitiesPackageItems::with([
                    'utilities_items:id,name',
                ])->where(
                    [
                        ['utilities_packages_id', '=', $utilities_packages_id],
                        ['status', '=', 'active'],
                    ]
                )->get();

                $utilities_items = [];
                foreach ($utilities_packages_items as $key1 => $value1)
                {
                    $utilities_items[$key1]                    = $value1['utilities_items'];
                    $results[$key]['utilities_packages_items'] = $utilities_items;
                }
            }
        }

        return response()->json($results, 200);
    }

    public function index()
    {
        $results = Rooms::with([
            'room_categories:id,name',
            'apartments:id,name',
            'utilities_packages:id,name',
            'renters:id,first_name,last_name',
        ])->get();

        return response()->json($results, 200);
    }

    public function update(Request $request)
    {
        $this->RuleValidate($request);

        $inputs = $request->all();
        Rooms::updateOrCreate(['id' => $inputs['id']], $inputs);

        return response()->json($inputs, 200);
    }

    private function RuleValidate($request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'apartments_id'         => 'nullable|numeric',
            'room_categories_id'    => 'nullable|numeric',
            'price'                 => 'required|alpha_num',
            'status'                => 'required',
            'utilities_packages_id' => 'nullable|numeric',
            'renters_id'            => 'nullable|numeric',
            'status'                => [
                'required',
                Rule::in(['active', 'disabled', 'rented_room']),
            ],
        ]);
    }
}
