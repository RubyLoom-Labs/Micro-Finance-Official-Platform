<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 *
 *
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Validation\ValidationException;

class UserRepository
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
    }

    public function create($branch)
    {
        try {
            return $this->users->create($branch);
        } catch (\Exception $e) {
            dd($e);
            return $e;
        }
    }
    public function search_one($type, $value)
    {
        try {
            return $this->users->where([$type => $value, 'status' => 'ACTIVE'])->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function search_many($type, $value)
    {
        try {
            return $this->users->where([$type => $value, 'status' => 'ACTIVE'])->get();
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function get_all()
    {
        try {
            return $this->users->where(['status' => 'ACTIVE'])->get();
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
