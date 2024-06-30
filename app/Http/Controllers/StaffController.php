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
        if ($request->has('id') && $request->id == 1) {
            return redirect(avenue_route('staffs.index'));
        }

        $validated = $request->validated();

        // Remove null values
        $data = array_filter($validated, function ($value) {
            return !is_null($value);
        });
    
        if (isset($data['password'])) {
            $data['password'] = bcrypt($request->get('password'));
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = upload_file($request->file('image'), 'images/profiles');
        }

        // Update or create user based on ID existence
        User::updateOrCreate(
            ['id' => $request->id],
            $data
        );

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
