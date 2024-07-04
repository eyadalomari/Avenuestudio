<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\ProfileRepository;

class ProfileController extends AdminController
{
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function index()
    {
        $user = Auth::user();

        return view('cms/profile/index', compact('user'));
    }

    public function store(ProfileRequest $request)
    {
        $validated = $request->validated();
        $this->profileRepository->saveProfile($validated);

        return redirect(avenue_route('profile.index'))->with('success', 'Profile saved successfully.');
    }

}
