<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'guarantor',
        'image_1',
        'image_2',
        'document_charges',
        'issue_date',
        'status',
        'interest',
        'terms',
        'interest_rate',
        'installment_price',
        'loan_amount',
        'status',
        'member_id',
        'completed_date'
    ];
    function member()
    {
        return $this->belongsTo('App\Models\Member', 'member_id', 'id');
    }

    function installment()
    {
        return $this->hasMany('App\Models\Installment', 'loan_id', 'id');
    }
}
