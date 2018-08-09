<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomCategories extends Model
{
    protected $table    = 'room_categories';
    protected $fillable = ['name', 'status'];
}
