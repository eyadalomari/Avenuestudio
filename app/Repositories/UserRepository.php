<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function list()
    {

        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $users = User::paginate(env('PER_PAGE', 12));

        foreach ($users as $user) {
            foreach ($user->role->labels as $row) {
                if ($row->language_id == $languageId) {
                    $user->role_name = $row->name;
                }
            }
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

        $user = User::findOrFail($user_id);

        foreach ($user->role->labels as $row) {
            if ($row->language_id == $languageId) {
                $user->role_name = $row->name;
            }
        }

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

    public function getUsersByRole($role)
    {
        return User::whereHas('role', function ($query) use ($role) {
            $query->where('code', $role);
        })->get();
    }
}
