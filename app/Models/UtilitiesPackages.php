<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesPackages extends Model
{
    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    protected $table = 'utilities_packages';

    public function utilities_items()
    {
        return $this->hasOne('App\Models\UtilityCategories', 'id', 'utility_categories_id');
    }

    public function utilities_package_items()
    {
        return $this->hasMany('App\Models\UtilitiesPackageItems', 'utilities_packages_id', 'id');
    }
}
