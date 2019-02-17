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
        $results = $this->find_bill_data_by_rooms_id_and_month($rooms_id, $month);

        $width          = 500;
        $height         = 400;
        $margin_left    = 30;
        $apartment_name = $results['apartments']['name'] ?? null;

        // header('Content-Type: image/png');
        $images           = ImageCreate($width, $height);
        $background_color = imagecolorallocate($images, 255, 255, 255);
        // $text_color       = imagecolorallocate($images, 233, 14, 91);
        $text_color = imagecolorallocate($images, 0, 0, 0);
        // imagestring($images, 1, 5, 5, $apartment_name, $text_color);
        // imagettftext($images, 14, 0, $margin_left, 342, $text_color, $font_bold_path, $groups_title);
        imagettftext($images, 14, 0, $margin_left, 342, $text_color, null, $apartment_name);
        imagepng($images);
        imagedestroy($images);

        // return response()->json($results, 200);
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

    private function find_bill_data_by_rooms_id_and_month($rooms_id, $month)
    {
        $results = Rooms::with([
            'apartments',
            'utilities_monthly_usage' => function ($query) use ($month)
            {
                $query->select('utilities_monthly_usage.*', 'utility_categories.name AS utilities_categories_name')
                    ->leftJoin('utility_categories', 'utilities_monthly_usage.utility_categories_id', '=', 'utility_categories.id')
                    ->where('utilities_monthly_usage.status', '=', 'active')
                    ->whereMonth('utilities_monthly_usage.utility_memo_date', date('m', strtotime($month)))
                    ->whereYear('utilities_monthly_usage.utility_memo_date', date('Y', strtotime($month)));
            },
        ])->find($rooms_id);

        $results['utility_memo_date_th'] = date('d/m/Y', strtotime('+543 years', strtotime($month)));

        return $results;
    }
}
