<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleI18n;

class RoleRepository
{
    public function list()
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return Role::select('roles.id', 'roles.code', 'roles.sort', 'roles.created_at', 'roles.updated_at', 'roles_i18n.name')
            ->join('roles_i18n', 'roles.id', '=', 'roles_i18n.role_id')
            ->where('roles_i18n.language_id', $languageId)
            ->paginate(env('PER_PAGE', 12));
    }

    public function getAllByLanguage($languageId)
    {
        return RoleI18n::where('language_id', $languageId)->get();
    }

    public function store()
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
    }

    public function findById($role_id)
    {
        $role = Role::findOrFail($role_id);
        
        $reindexedLabels = [];
        foreach ($role->labels as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $role->labels = $reindexedLabels;

        return $role;
    }
}
