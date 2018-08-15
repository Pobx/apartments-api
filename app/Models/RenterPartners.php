<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenterPartners extends Model
{
    protected $table = 'renter_partners';

    protected $fillable = [
        'renters_id',
        'first_name',
        'last_name',
        'mobile',
        'status',
    ];
}
