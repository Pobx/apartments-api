<?php

namespace App\Http\Controllers;

class DatesController extends Controller
{
    public function setDateEn($data)
    {
        $date    = str_replace('/', '-', $data);
        $results = date('Y-m-d', strtotime("{$date} -543 year"));

        return $results;

    }
}
