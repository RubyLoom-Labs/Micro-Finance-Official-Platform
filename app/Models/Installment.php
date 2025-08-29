<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'amount',
        'installment_amount',
        'bill_image',
        'installment_number',
        'payed_date',
        'pay_in_date',
        'date_and_time',
        'status',
        'loan_id'
    ];
    function loan()
    {
        return $this->belongsTo('App\Models\Loan', 'loan_id', 'id');
    }
    function underpayment()
    {
        return $this->hasMany('App\Models\Underpayment', 'installment_id', 'id');
    }
}
