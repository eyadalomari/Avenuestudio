<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Repositories\RoleRepository;

class AdminController extends Controller
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->list();
        $permissions = Permission::all();
        $users = User::with('roles')->get();

        return view('cms/permissions/permission', compact('roles', 'permissions', 'users'));
    }

    public function assignRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        $user->roles()->attach($role);

        return back()->with('success', 'Role assigned successfully.');
    }

    public function assignPermission(Request $request)
    {
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        $role->permissions()->attach($permission);

        return back()->with('success', 'Permission assigned successfully.');
    }
}
