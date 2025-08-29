<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Installment;
use Exception;
use Illuminate\Validation\ValidationException;

class InstallmentRepository
{
    protected $installments;

    public function __construct(Installment $installments)
    {
        $this->installments = $installments;
    }

    public function create($branch)
    {
        try {
            return $this->installments->create($branch);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->installments->where([$type => $value])->with('loan.member')->first();
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->installments->where([$type => $value, 'status' => 'ACTIVE'])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->installments->where(['status' => 'ACTIVE'])->get();
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
