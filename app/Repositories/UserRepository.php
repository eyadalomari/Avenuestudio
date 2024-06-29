<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getUsersByRole($role)
    {
        return User::whereHas('role', function ($query) use ($role) {
            $query->where('code', $role);
        })->get();
    }
}
