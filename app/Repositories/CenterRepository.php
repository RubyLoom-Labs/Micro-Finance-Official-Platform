<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Center;
use Exception;
use Illuminate\Validation\ValidationException;

class CenterRepository
{
    protected $centers;

    public function __construct(Center $centers)
    {
        $this->centers = $centers;
    }

    public function create($center)
    {
        try {
            return $this->centers->create($center);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->centers->where([$type => $value, 'status' => 'ACTIVE'])->with([
                'branch',
                'group' => function ($query) {
                    $query->where('status', 'ACTIVE');
                },
                'group.member' => function ($query) {
                    $query->where('status', '!=', 'TERMINATED');
                },
            ])->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->centers->where([$type => $value, 'status' => 'ACTIVE'])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->centers
                ->where('status', 'ACTIVE')
                ->with([
                    'branch',
                    'group' => function ($query) {
                        $query->where('status', 'ACTIVE');
                    },
                    'group.member' => function ($query) {
                        $query->where('status', '!=', 'TERMINATED');
                    },
                ])
                ->get();
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
