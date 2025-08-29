<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Center;
use App\Models\UserRole;
use Exception;
use Illuminate\Validation\ValidationException;

class UserRoleRepository
{
    protected $user_roles;

    public function __construct(UserRole $user_roles)
    {
        $this->user_roles = $user_roles;
    }

    public function create($center)
    {
        try {
            return $this->user_roles->create($center);
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->user_roles->where([$type => $value, 'status' => 'ACTIVE'])->with('users')->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->user_roles->where([$type => $value, 'status' => 'ACTIVE'])->with('users')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->user_roles->where(['status' => 'ACTIVE'])->with('users')->get();
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
