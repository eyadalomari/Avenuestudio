<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\User;
use App\Models\RoleI18n;
use App\Repositories\UserRepository;

class StaffController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->list();
        
        return view('cms/staffs/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RoleI18n::where('language_id', $languageId)->get();

        return view('cms/staffs/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffRequest $request)
    {
        // If the user ID is 1, redirect to the staff index (typically for admin protection)
        if ($request->has('id') && $request->id == 1) {
            return redirect(avenue_route('staffs.index'));
        }
    
        // Validate the request data
        $validated = $request->validated();
    
        // Remove null values from the validated data
        $data = array_filter($validated, function ($value) {
            return !is_null($value);
        });
    
        // Hash the password if it's set in the request
        if (isset($data['password'])) {
            $data['password'] = bcrypt($request->get('password'));
        }
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = upload_file($request->file('image'), 'images/profiles');
        }
    
        // Update or create the user based on the ID existence
        $user = User::updateOrCreate(
            ['id' => $request->id],
            $data
        );
    
        // Sync the roles if role_ids are present in the request
        if ($request->has('role_ids')) {
            $user->roles()->sync($request->input('role_ids'));
        }
    
        return redirect(avenue_route('staffs.index'))->with('success', 'Staff saved successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->findById($id);

        return view('cms/staffs/view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!empty($id) && $id == 1) {
            return redirect(avenue_route('staffs.index'));
        }

        $languageId = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RoleI18n::where('language_id', $languageId)->get();

        $user = $this->userRepository->findById($id);

        return view('cms/staffs/create', compact('roles', 'user'));
    }
}
