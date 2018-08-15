<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renters extends Model
{
    protected $table    = 'renters';
    protected $fillable = [
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
}
