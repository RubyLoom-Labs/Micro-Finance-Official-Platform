<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'role_name',
        'description',
        'dashboard',
        'branch_creation',
        'user_accounts_creation',
        'user_role_creation',
        'centers',
        'members',
        'income',
        'payments',
        'reports',
        'status',
    ];

    // Relationship to users
    public function users()
    {
        return $this->hasMany(User::class, 'user_role_id', 'id');
    }
}
