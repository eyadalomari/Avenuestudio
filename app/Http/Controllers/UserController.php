<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

class UserController extends AdminController
{
    private $userRepository;
    private $roleRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $users = $this->userRepository->list();

        return view('cms/users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleRepository->list(false);

        return view('cms/users/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $this->userRepository->store($validated);
    
        return redirect(avenue_route('users.index'))->with('success', 'User saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->findById($id);

        return view('cms/users/view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!empty($id) && $id == 1) {
            return redirect(avenue_route('users.index'));
        }

        $roles = $this->roleRepository->list(false);

        $user = $this->userRepository->findById($id);

        return view('cms/users/create', compact('roles', 'user'));
    }
}
