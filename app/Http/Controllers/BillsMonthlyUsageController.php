<?php

namespace App\Http\Controllers;

use App\Models\Rooms;

class BillsMonthlyUsageController extends Controller
{
    private $dateController = null;

    private $filesController = null;

    private $public_path = null;

    public function __construct()
    {
        $this->public_path     = $_SERVER['DOCUMENT_ROOT'] . '/public/';
        $this->dateController  = new DatesController;
        $this->filesController = new FilesController;
    }

    public function create_bill($rooms_id, $month)
    {
        $results = $this->find_bill_data_by_rooms_id_and_month($rooms_id, $month);

        $width                            = 500;
        $height                           = 400;
        $margin_left                      = 30;
        $margin_left_items_currency_label = 350;
        $items_margin_top                 = 200;

        $apartment_name          = $results['apartments']['name'] ?? null;
        $room_name               = $results['name'] ?? null;
        $apartment_label         = $apartment_name . ' (' . $room_name . ' )';
        $utility_memo_date_en    = $results['utility_memo_date_en'] ?? date('Y-m-d');
        $bill_suffix             = date('mY', strtotime($utility_memo_date_en));
        $date_month_thai_label   = $this->dateController->get_month_thai_full_text($utility_memo_date_en);
        $room_price_item_label   = $results['price'] ?? 0;
        $room_price_label        = 'ค่าห้อง';
        $items_prices            = 0;
        $items_label             = 'รายการ';
        $items_currency_label    = 'บาท';
        $unit_amount_label       = 'หน่วย';
        $total_label             = 'รวม';
        $utilities_monthly_usage = $results['utilities_monthly_usage'] ?? [];

        // header('Content-Type: image/png');
        $font_regular_path = $this->public_path . 'prompt/Prompt-Regular.ttf';
        $font_bold_path    = $this->public_path . 'prompt/Prompt-Bold.ttf';
        $images            = ImageCreate($width, $height);
        $background_color  = imagecolorallocate($images, 255, 255, 255);
        $text_color        = imagecolorallocate($images, 0, 0, 0);

        imagettftext($images, 14, 0, $margin_left, 30, $text_color, $font_regular_path, $apartment_label);
        imagettftext($images, 14, 0, $margin_left, 70, $text_color, $font_regular_path, $date_month_thai_label);

        // headers
        imagettftext($images, 14, 0, $margin_left, 130, $text_color, $font_regular_path, $items_label);
        imagettftext($images, 14, 0, $margin_left_items_currency_label, 130, $text_color, $font_regular_path, $items_currency_label);
        imagettftext($images, 14, 0, 150, 130, $text_color, $font_regular_path, $unit_amount_label);
        imagettftext($images, 14, 0, 230, 130, $text_color, $font_regular_path, $unit_amount_label);

        // room pirce
        imagettftext($images, 14, 0, $margin_left, 170, $text_color, $font_regular_path, $room_price_label);
        imagettftext($images, 14, 0, $margin_left_items_currency_label, 170, $text_color, $font_regular_path, number_format($room_price_item_label));

        foreach ($utilities_monthly_usage as $key => $value)
        {
            imagettftext($images, 14, 0, $margin_left, $items_margin_top, $text_color, $font_regular_path, $value['utilities_categories_name']);
            imagettftext($images, 14, 0, 170, $items_margin_top, $text_color, $font_regular_path, number_format($value['latest_unit_amount']));
            imagettftext($images, 14, 0, 250, $items_margin_top, $text_color, $font_regular_path, number_format($value['current_unit_amount']));
            imagettftext($images, 14, 0, $margin_left_items_currency_label, $items_margin_top, $text_color, $font_regular_path, number_format($value['total_price']));

            $items_prices += $value['total_price'];
            $items_margin_top += 20;

        }

        $last_items_margin_top = ($items_margin_top + 50);
        $total_price           = $room_price_item_label + $items_prices;

        imagettftext($images, 14, 0, 300, $last_items_margin_top, $text_color, $font_bold_path, $total_label);
        imagettftext($images, 14, 0, $margin_left_items_currency_label, $last_items_margin_top, $text_color, $font_bold_path, number_format($total_price));

        $filename = 'bills_' . $bill_suffix . '_' . date('YmdHis') . '_' . uniqid() . '_' . '.png';
        $path     = $this->public_path . 'attached_files/' . $filename;

        // save images
        imagepng($images, $path);

        // Clear Memory
        imagedestroy($images);

        $link_url = $this->filesController->getFiles($filename, '/public/attached_files/');

        return response()->json([
            'results'  => $results,
            'filename' => $filename,
            'path'     => $path,
            'link_url' => $link_url,

        ], 200);
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
            $results['utilities_monthly_usage'][$key]['utility_memo_date_th'] = date('d/m/Y', strtotime('+543 years', strtotime($value['utility_memo_date'])));
            $results['utilities_monthly_usage'][$key]['utility_memo_monthly_th'] = date('m/Y', strtotime('+543 years', strtotime($value['utility_memo_date'])));
            $results['utilities_monthly_usage'][$key]['utility_memo_monthly_en'] = date('Y-m-d', strtotime($value['utility_memo_date']));
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
        $results['utility_memo_date_en'] = date('Y-m-d', strtotime($month));
        $results['utility_memo_year']    = date('Y', strtotime('+543 years', strtotime($month)));

        return $results;
    }
}
