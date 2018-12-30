<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renters extends Model
{
    protected $fillable = [
        'prefix',
        'first_name',
        'last_name',
        'id_card',
        'date_of_birth',
        'address',
        'attached_file_image',
        'mobile',
        'email',
        'status',
    ];

    protected $table = 'renters';

    public function rooms()
    {
        return $this->hasMany('App\Models\Rooms', 'renters_id', 'id');
    }

    public function attached_files()
    {
        return $this->hasOne('App\Models\RentersAttachedFiles', 'renters_id', 'id');
    }
}
