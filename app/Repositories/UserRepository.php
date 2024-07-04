<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;

class UserRepository
{
    public function list($withPaginate = true)
    {
        if($withPaginate){
            return User::paginate(env('PER_PAGE', 12));
        }
        
        return User::all();
    }

    public function findById($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function getUsersByRole($roleCode)
    {
        return User::whereHas('roles', function ($query) use ($roleCode) {
            $query->where('code', $roleCode);
        })->get();
    }

    public function store($data)
    {
        if (request()->id == 1) {
            return redirect(avenue_route('users.index'));
        }

        if ($password = request()->get('password')) {
            $data['password'] = bcrypt($password);
        }

        if (request()->hasFile('image')) {
            $data['image'] = upload_file(request()->file('image'), 'images/profiles');
        }

        $user = User::updateOrCreate(
            ['id' => request()->id],
            [
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'is_active' => $data['is_active'],
                'name' => $data['name'],
                'name' => $data['name'],
                'name' => $data['name'],
            ]
        );

        if (!empty($data['image'])) {
            $user->image = $data['image'];
            $user->save();
        }

        if (!empty($data['password'])) {
            $user->password = $data['password'];
            $user->save();
        }

        if (request()->has('role_ids')) {
            $roleIds = request()->role_ids;
            $existingRoles = Role::whereIn('id', $roleIds)->pluck('id')->toArray();

            if (count($existingRoles) !== count($roleIds)) {
                return redirect()->back()->withErrors(['role_ids' => 'One or more roles does not exist.']);
            }

            $user->roles()->sync($existingRoles);
        }
    }
}
