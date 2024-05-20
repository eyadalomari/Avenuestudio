<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('CMS.staff.index', compact('users'));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Roles::all();
        
        return view('CMS.staff.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:50',
            'mobile'=>'required|string|max:25',
            'email'=>'required',
            'role_id'=>'required|integer',
            'is_active'=>'required|integer',
            'password'=>'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->get('name'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'role_id' => $request->get('role_id'),
            'is_active' => $request->get('is_active'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('staffs.index')->with('success', 'Staff created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        
        return view('CMS.staff.view', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    } 
}
