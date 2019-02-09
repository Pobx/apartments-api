<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = [
        'name',
        'apartments_id',
        'room_categories_id',
        'price',
        'status',
        'utilities_packages_id',
        'renters_id',
    ];

    protected $table = 'rooms';

    public function apartments()
    {
        return $this->hasOne('App\Models\Apartments', 'id', 'apartments_id');
    }

    public function renters()
    {
        return $this->hasOne('App\Models\Renters', 'id', 'renters_id');
    }

    public function room_categories()
    {
        return $this->hasOne('App\Models\RoomCategories', 'id', 'room_categories_id');
    }

    public function utilities_packages()
    {
        return $this->hasOne('App\Models\UtilitiesPackages', 'id', 'utilities_packages_id');
    }

    public function utilities_monthly_usage()
    {
        return $this->hasOne('App\Models\UtilitiesMonthlyUsage', 'room_id', 'id');
    }
}
