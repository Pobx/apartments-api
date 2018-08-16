<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesMonthlyUsage extends Model
{
    protected $table = 'utilities_monthly_usage';

    protected $fillable = [
        'room_id',
        'utility_categories_id',
        'utility_memo_date',
        'unit_amount',
        'status',
    ];
}
