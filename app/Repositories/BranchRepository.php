<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Branch;
use Exception;
use Illuminate\Validation\ValidationException;

class BranchRepository
{
    protected $branches;

    public function __construct(Branch $branches)
    {
        $this->branches = $branches;
    }

    public function create($branch)
    {
        try {
            return $this->branches->create($branch);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->branches->where([$type => $value, 'status' => 'ACTIVE'])->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->branches->where([$type => $value, 'status' => 'ACTIVE'])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->branches->where(['status' => 'ACTIVE'])->with('center.group')->get();
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
