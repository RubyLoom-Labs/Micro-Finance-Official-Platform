<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Underpayment;
use Exception;
use Illuminate\Validation\ValidationException;

class UnderpaymentRepository
{
    protected $underpayment;

    public function __construct(Underpayment $underpayment)
    {
        $this->underpayment = $underpayment;
    }

    public function create($underpayment)
    {
        try {
            return $this->underpayment->create($underpayment);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->underpayment->where([$type => $value])->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->underpayment->where([$type => $value])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->underpayment->with('center.group')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update($id, $type, $value)
    {
        try {
            return $this->search_one('id', $id)->update([$type => $value]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
