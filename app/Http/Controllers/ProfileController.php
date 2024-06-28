<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('cms/profile/index', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'mobile' => ['required', 'string', 'max:25', Rule::unique('users')->ignore($request->user()->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($request->user()->id)],
            'password' => $request->filled('password') ? 'nullable|string|min:8|confirmed' : 'sometimes|nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = $request->only(['name', 'mobile', 'email']);
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->get('password'));
        }
    
        // Handle image upload
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
    
        $user = User::findOrFail($request->user()->id);
        $user->update($data);
    
        return redirect(avenue_route('profile.index'))->with('success', 'Profile updated successfully.');
    }
    
}
