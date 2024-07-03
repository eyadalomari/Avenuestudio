<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('cms/profile/index', compact('user'));
    }

    public function store(ProfileRequest $request)
    {
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

        $user = User::findOrFail($request->user()->id);
        $user->update($data);

        return redirect(avenue_route('profile.index'))->with('success', 'Profile saved successfully.');
    }

}
