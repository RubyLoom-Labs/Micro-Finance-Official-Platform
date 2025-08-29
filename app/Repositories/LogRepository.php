<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Log;
use Exception;
use Illuminate\Validation\ValidationException;

class LogRepository
{
    protected $logs;

    public function __construct(Log $logs)
    {
        $this->logs = $logs;
    }

    public function create($log)
    {
        try {
            return $this->logs->create($log);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
    public function search_one($valuedArray)
    {
        try {
            return $this->logs->where($valuedArray)->first();
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->logs->where([$type => $value])->with('installment.underpayment','member.group.center.branch')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->logs->get();
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update($id, $type, $value)
    {
        try {
            return $this->search_one(['id'=> $id])->update([$type => $value]);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
}
