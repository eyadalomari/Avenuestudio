<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return view('cms/users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        if ($request->has('id') && $request->id == 1) {
            return redirect(avenue_route('users.index'));
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

        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $user = $this->userRepository->findById($id);

        return view('cms/users/create', compact('user'));
    }
}
