<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Underpayment extends Model
{
 use HasFactory;
    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';


    protected $fillable = [
        'amount',
        'bill_image',
        'installment_id',
        'payed_date',
    ];
    function installment()
    {
        return $this->belongsTo('App\Models\Installment', 'installment_id', 'id');
    }}
