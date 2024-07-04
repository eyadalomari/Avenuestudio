<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    public function getAllPermissions()
    {
        return Permission::orderBy('section')->get();
    }
}
