<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    protected $table    = 'apartments';
    protected $fillable = ['name', 'status'];
}
