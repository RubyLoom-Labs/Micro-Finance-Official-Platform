<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Group;
use Exception;
use Illuminate\Validation\ValidationException;

class GroupRepository
{
    protected $groups;

    public function __construct(Group $groups)
    {
        $this->groups = $groups;
    }

    public function create($center)
    {
        try {
            return $this->groups->create($center);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->groups
                ->where($type, $value)
                ->where('status', 'ACTIVE')
                ->with([
                    'member' => function ($query) {
                        $query->where('status', '!=', 'TERMINATED')
                            ->with('loan');
                    },
                    'center.branch'
                ])
                ->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->groups->where([$type => $value, 'status' => 'ACTIVE'])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->groups->where(['status' => 'ACTIVE'])->get();
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
