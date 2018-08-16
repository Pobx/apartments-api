<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilityCategories extends Model
{
    protected $table = 'utility_categories';

    protected $fillable = [
        'name',
        'price_per_unit_cost',
        'price_per_unit',
        'unit_min_rate',
        'unit_min_price',
        'type',
        'status',
    ];
}
