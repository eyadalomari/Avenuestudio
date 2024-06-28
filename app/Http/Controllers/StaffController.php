<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleI18n;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index()
    {
        $users = User::paginate(config('constants.PAGINATION'));
        return view('cms/staffs/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RoleI18n::where('language_id', $language_id)->get();

        return view('cms/staffs/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('id') && $request->id == 1) {
            return redirect(avenue_route('staffs.index'));
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'mobile' => ['required', 'string', 'max:25', Rule::unique('users')->ignore($request->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->id)],
            'role_id' => 'required|integer',
            'is_active' => 'required|integer',
            'password' => $request->has('id') ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'mobile', 'email', 'role_id', 'is_active']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }

        // Handle iamge upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profiles');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = 'images/profiles/' . $imageName;
        }

        if ($request->has('id')) {
            $user = User::findOrFail($request->id);
            $user->update($data);
            return redirect(avenue_route('staffs.index'))->with('success', 'Staff updated successfully.');
        } else {
            User::create($data);
            return redirect(avenue_route('staffs.index'))->with('success', 'Staff created successfully.');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

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

        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RoleI18n::where('language_id', $language_id)->get();

        $user = User::findOrFail($id);

        return view('cms/staffs/create', compact('roles', 'user'));
    }
}
