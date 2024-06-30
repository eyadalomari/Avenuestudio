<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function list()
    {
        return User::paginate(env('PER_PAGE', 12));
    }

    public function findById($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function all()
    {
        return User::all();
    }
}
