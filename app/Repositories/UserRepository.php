<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;

class UserRepository
{
    public function list()
    {

        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $users = User::with(['roles.labels' => function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }])->paginate(env('PER_PAGE', 12));

        foreach ($users as $user) {
            $user->role_names = $user->roles->flatMap(function ($role) use ($languageId) {
                return $role->labels->where('language_id', $languageId)->pluck('name');
            })->toArray();
        }


        return $users;

        /*
        return User::select('users.*', 'roles_i18n.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('roles_i18n', function ($join) use ($languageId) {
                $join->on('roles.id', '=', 'roles_i18n.role_id')
                     ->where('roles_i18n.language_id', $languageId);
            })
            ->paginate(env('PER_PAGE', 12));
        */
    }

    public function findById($user_id)
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $user = User::with(['roles.labels' => function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }])->findOrFail($user_id);

        $user->role_names = $user->roles->flatMap(function ($role) use ($languageId) {
            return $role->labels->where('language_id', $languageId)->pluck('name');
        })->toArray();

        return $user;

        /*
        return User::select('users.*', 'roles_i18n.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('roles_i18n', function ($join) use ($languageId) {
                $join->on('roles.id', '=', 'roles_i18n.role_id')
                     ->where('roles_i18n.language_id', $languageId);
            })
            ->where('users.id', $user_id)
            ->firstOrFail();
        */
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
