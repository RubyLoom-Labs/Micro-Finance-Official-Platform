<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'branch_name',
        'status'
    ];

    function center()
    {
        return $this->hasMany('App\Models\Center', 'branch_id', 'id');
    }
}
