<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesPackages extends Model
{
    protected $table = 'utilities_packages';

    protected $fillable = [
        'name',
        'status',
    ];
}
