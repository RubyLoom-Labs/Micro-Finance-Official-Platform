<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'center_name',
        'manager_name',
        'payment_date',
        'status',
        'branch_id'
    ];
    function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id', 'id');
    }

    function group()
    {
        return $this->hasMany('App\Models\Group', 'center_id', 'id');
    }
}
