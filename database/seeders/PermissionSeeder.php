<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['section' => 'User', 'name' => 'index-user', 'class_code' => 'UserController', 'method_code' => 'index']);
        Permission::create(['section' => 'User', 'name' => 'create-user', 'class_code' => 'UserController', 'method_code' => 'create']);
        Permission::create(['section' => 'User', 'name' => 'edit-user', 'class_code' => 'UserController', 'method_code' => 'edit']);
        Permission::create(['section' => 'User', 'name' => 'show-user', 'class_code' => 'UserController', 'method_code' => 'show']);

        Permission::create(['section' => 'Reservation', 'name' => 'index-reservation', 'class_code' => 'ReservationController', 'method_code' => 'index']);
        Permission::create(['section' => 'Reservation', 'name' => 'create-reservation', 'class_code' => 'ReservationController', 'method_code' => 'create']);
        Permission::create(['section' => 'Reservation', 'name' => 'edit-reservation', 'class_code' => 'ReservationController', 'method_code' => 'edit']);
        Permission::create(['section' => 'Reservation', 'name' => 'show-reservation', 'class_code' => 'ReservationController', 'method_code' => 'show']);

        Permission::create(['section' => 'Role', 'name' => 'index-role', 'class_code' => 'RoleController', 'method_code' => 'index']);
        Permission::create(['section' => 'Role', 'name' => 'create-role', 'class_code' => 'RoleController', 'method_code' => 'create']);
        Permission::create(['section' => 'Role', 'name' => 'edit-role', 'class_code' => 'RoleController', 'method_code' => 'edit']);
        Permission::create(['section' => 'Role', 'name' => 'show-role', 'class_code' => 'RoleController', 'method_code' => 'show']);

        Permission::create(['section' => 'Status', 'name' => 'index-status', 'class_code' => 'StatusController', 'method_code' => 'index']);
        Permission::create(['section' => 'Status', 'name' => 'create-status', 'class_code' => 'StatusController', 'method_code' => 'create']);
        Permission::create(['section' => 'Status', 'name' => 'edit-status', 'class_code' => 'StatusController', 'method_code' => 'edit']);
        Permission::create(['section' => 'Status', 'name' => 'show-status', 'class_code' => 'StatusController', 'method_code' => 'show']);

        Permission::create(['section' => 'Type', 'name' => 'index-type', 'class_code' => 'TypeController', 'method_code' => 'index']);
        Permission::create(['section' => 'Type', 'name' => 'create-type', 'class_code' => 'TypeController', 'method_code' => 'create']);
        Permission::create(['section' => 'Type', 'name' => 'edit-type', 'class_code' => 'TypeController', 'method_code' => 'edit']);
        Permission::create(['section' => 'Type', 'name' => 'show-type', 'class_code' => 'TypeController', 'method_code' => 'show']);

        $role = Role::findOrFail(1);
        $role->permissions()->sync(Permission::all()->pluck('id')->toArray());
    }
}
