<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentersAttachedFiles extends Model
{
    protected $table = 'renters_attached_files';

    protected $fillable = [
        'renters_id',
        'attached_name',
        'status',
    ];
}
