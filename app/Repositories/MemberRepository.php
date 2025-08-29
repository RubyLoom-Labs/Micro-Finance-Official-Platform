<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Member;
use Exception;
use Illuminate\Validation\ValidationException;

class MemberRepository
{
    protected $members;

    public function __construct(Member $members)
    {
        $this->members = $members;
    }

    public function create($branch)
    {
        try {
            return $this->members->create($branch);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->members
                ->where($type, $value)
                ->whereIn('status', ['ACTIVE', 'INACTIVE'])->with('group.center.branch', 'loan.installment.underpayment')
                ->first();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function un_assign_member_search($query)
    {
        try {
            return $this->members
                ->where('full_name', 'like', '%' . $query . '%')
                ->where('status', 'UNASSIGN')
                ->limit(10)
                ->get(['id', 'full_name']);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->members
                ->where($type, $value)
                ->whereIn('status', ['ACTIVE', 'INACTIVE'])->with('loan.installment.underpayment')
                ->first();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->members->whereIn('status', ['INACTIVE', 'ACTIVE'])->with('group.center.branch', 'loan.installment.underpayment')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function update($id, $type, $value)
    {
        try {
            return $this->search_one('id', $id)->update([$type => $value]);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
}
