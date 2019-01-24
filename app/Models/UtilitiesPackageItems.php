<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilitiesPackageItems extends Model
{
    protected $fillable = [
        'id',
        'utilities_packages_id',
        'utility_categories_id',
        'status',
    ];

    protected $table = 'utilities_package_items';

    public function utilities_items()
    {
        return $this->hasOne('App\Models\UtilityCategories', 'id', 'utility_categories_id');
    }
}
