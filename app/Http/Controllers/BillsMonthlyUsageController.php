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

    public function find_bill_by_rooms_id($rooms_id)
    {
        $results = Rooms::where([
            ['id', '=', $rooms_id],
        ])
            ->with([
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
            ])
            ->get();

        return response()->json($results, 200);
    }

    public function create_bill($rooms_id, $month)
    {
      return $rooms_id.' ==== '.$month;
    }
}
