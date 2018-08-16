<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesPackageList extends Model
{
    protected $table = 'utilities_package_list';

    protected $fillable = [
        'id',
        'utilities_packages_id',
        'utility_categories_id',
        'status',
    ];
}
