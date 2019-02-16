<?php

namespace App\Http\Controllers;

use App\Models\Rooms;

class BillsMonthlyUsageController extends Controller
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

    public function create_bill($rooms_id, $month)
    {
        $results = Rooms::with([
            'utilities_monthly_usage' => function ($query) use ($month)
            {
                $query->select('utilities_monthly_usage.*', 'utility_categories.name AS utilities_categories_name')
                    ->leftJoin('utility_categories', 'utilities_monthly_usage.utility_categories_id', '=', 'utility_categories.id')
                    ->where('utilities_monthly_usage.status', '=', 'active')
                    ->whereMonth('utilities_monthly_usage.utility_memo_date', date('m', strtotime($month)))
                    ->whereYear('utilities_monthly_usage.utility_memo_date', date('Y', strtotime($month)));
            },
        ])->find($rooms_id);

        $results['utility_memo_date_th'] =  date('d/m/Y', strtotime('+543 years', strtotime($month)));
        // foreach ($results['utilities_monthly_usage'] as $key => $value)
        // {
        //     $results['utilities_monthly_usage'][$key]['utility_memo_month_th'] = date('Y-m', strtotime($value['utility_memo_date']));
        // }

        return response()->json($results, 200);
    }

    public function find_bill_by_rooms_id($rooms_id)
    {
        $results = Rooms::with([
            'utilities_monthly_usage' => function ($query)
            {
                $query->select('utilities_monthly_usage.*', 'utility_categories.name AS utilities_categories_name')
                    ->leftJoin('utility_categories', 'utilities_monthly_usage.utility_categories_id', '=', 'utility_categories.id')
                    ->where('utilities_monthly_usage.status', '=', 'active')
                    ->whereYear('utilities_monthly_usage.utility_memo_date', '>=', date('Y') - 1)
                    ->whereYear('utilities_monthly_usage.utility_memo_date', '<=', (date('Y')))
                    ->groupBy('utilities_monthly_usage.utility_memo_date')
                    ->orderBy('utilities_monthly_usage.utility_memo_date', 'desc');
            },
        ])->find($rooms_id);

        foreach ($results['utilities_monthly_usage'] as $key => $value)
        {
            $results['utilities_monthly_usage'][$key]['utility_memo_month_th'] = date('Y-m-d', strtotime($value['utility_memo_date']));
        }

        return response()->json($results, 200);
    }
}
