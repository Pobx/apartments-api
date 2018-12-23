<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'apartments_id',
        'room_categories_id',
        'price',
        'status',
        'utilities_packages_id',
        'renters_id',
    ];

    public function room_categories()
    {
        return $this->hasOne('App\Models\RoomCategories', 'id');
    }

    public function apartments()
    {
        return $this->hasOne('App\Models\Apartments', 'id');
    }
}
