<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Language;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    private $roleRepository;
    
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function index()
    {
        $roles = $this->roleRepository->list();

        return view('cms/roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all()->keyBy('id');

        return view('cms/roles/create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepository->store();

        return redirect(avenue_route('roles.index'))->with('success', 'Role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $role = $this->roleRepository->findById($id);

        return view('cms/roles/view', compact('role', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $role = $this->roleRepository->findById($id);

        return view('cms/roles/create', compact('role', 'languages'));
    }
}
