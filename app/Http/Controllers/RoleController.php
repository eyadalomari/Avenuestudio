<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Language;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends AdminController
{
    private $roleRepository;
    private $permissionRepository;
    
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        parent::__construct();
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        $roles = $this->roleRepository->getAllRoles();

        return view('cms/roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all()->keyBy('id');
        $permissions = $this->permissionRepository->getAllPermissions();

        return view('cms/roles/create', compact('permissions', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepository->storeRole();

        return redirect(avenue_route('roles.index'))->with('success', 'Role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $role = $this->roleRepository->getRoleById($id);

        return view('cms/roles/view', compact('role', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all()->keyBy('id');
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->permissionRepository->getAllPermissions();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('cms/roles/create', compact('role', 'permissions', 'languages', 'rolePermissions'));
    }
}
