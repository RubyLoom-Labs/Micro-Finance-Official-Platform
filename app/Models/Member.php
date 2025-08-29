<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'full_name',
        'mobile_number_1',
        'mobile_number_2',
        'image_1',
        'image_2',
        'gender',
        'address',
        'nic_number',
        'status',
        'group_id'
    ];
    function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    function loan()
    {
        return $this->hasMany('App\Models\Loan', 'member_id', 'id');
    }
}
