<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('CMS.staffs.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = (new Roles())->getRoles(false);

        return view('CMS.staffs.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('user_id') && $request->user_id == 1) {
            return redirect(avenue_route('staffs.index'));
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'mobile' => ['required', 'string', 'max:25', Rule::unique('users')->ignore($request->user_id, 'user_id')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->user_id, 'user_id')],
            'role_id' => 'required|integer',
            'is_active' => 'required|integer',
            'password' => $request->has('user_id') ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
        ]);
        if ($request->has('user_id')) {
            $user = User::findOrFail($request->user_id);
            $user->update([
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
                'role_id' => $request->get('role_id'),
                'is_active' => $request->get('is_active'),
                'password' => Hash::make($request->get('password')),
            ]);
        } else {
            User::create([
                'name' => $request->get('name'),
                'mobile' => $request->get('mobile'),
                'email' => $request->get('email'),
                'role_id' => $request->get('role_id'),
                'is_active' => $request->get('is_active'),
                'password' => Hash::make($request->get('password')),
            ]);
        }

        return redirect(avenue_route('staffs.index'))->with('success', 'Staff created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('CMS.staffs.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!empty($id) && $id == 1) {
            return redirect(avenue_route('staffs.index'));
        }

        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $roles = (new Roles())->getRoles(false);

        $user = User::findOrFail($id);

        return view('CMS.staffs.create', compact('roles', 'user'));
    }
}
