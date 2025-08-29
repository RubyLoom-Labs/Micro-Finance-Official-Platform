<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'group_name',
        'status',
        'center_id',
    ];
    function center()
    {
        return $this->belongsTo('App\Models\Center', 'center_id', 'id');
    }

    function member()
    {
        return $this->hasMany('App\Models\Member', 'group_id', 'id');
    }
}
