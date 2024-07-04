<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleI18n;

class RoleRepository
{
    public function getAllRoles($withPaginate = true)
    {
        if($withPaginate){
            return Role::paginate(env('PER_PAGE', 12));
        }

        return Role::all();
    }

    public function storeRole()
    {
        $role = Role::updateOrCreate(
            [
                'id' => request()->id
            ],
            [
                'code' => request()->code,
                'sort' => request()->sort,
            ]
        );


        foreach (request()->name as $languageId => $name) {
            RoleI18n::updateOrCreate(
                [
                    'role_id' => $role->id,
                    'language_id' => $languageId,
                ],
                [
                    'name' => $name
                ]
            );
        }

        if (request()->has('permissions')) {
            $role->permissions()->sync(request()->permissions);
        } else {
            $role->permissions()->detach();
        }
    
    }

    public function getRoleById($role_id)
    {
        $role = Role::findOrFail($role_id);
        $role->labels = $role->labels->keyBy('language_id');
        
        return $role;
    }
}
