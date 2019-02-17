<?php

namespace App\Http\Controllers;

class DatesController extends Controller
{
    private $list_month_thai = [
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    ];

    public function get_month_thai_full_text($date = null)
    {
        $date = $date ?? date('Y-m-d');

        $date_explod = explode('-', $date);
        $results  = $this->list_month_thai[$date_explod[1]] . ' ' . ($date_explod[0] + 543);

        return $results;
    }

    public function setDateEn($data)
    {
        $date    = str_replace('/', '-', $data);
        $results = date('Y-m-d', strtotime("{$date} -543 year"));

        return $results;

    }
}
