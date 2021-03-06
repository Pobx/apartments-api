<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesMonthlyUsage extends Model
{
    protected $fillable = [
        'room_id',
        'utility_categories_id',
        'utility_memo_date',
        'latest_unit_amount',
        'current_unit_amount',
        'unit_amount',
        'price_per_unit',
        'total_price',
        'status',
    ];

    protected $table = 'utilities_monthly_usage';
}
