<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\RolesLabel;
use App\Models\Languages;
use Illuminate\Validation\Rule;
use App\Models\User;

class RolesController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RolesLabel::where('language_id', $language_id)->paginate(config('constants.PAGINATION'));

        return view('cms.roles.index', compact('roles', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Languages::all()->keyBy('language_id');
        return view('cms.roles.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('roles')->ignore($request->role_id, 'role_id')],
            'sort' => 'required|integer',
            'name.*' => 'required|string|max:50',
        ]);

        if ($request->has('role_id')) {
            $role = Roles::find($request->get('role_id'));
            $role->update([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        } else {
            $role = Roles::create([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            RolesLabel::updateOrCreate(
                [
                    'role_id' => $role->role_id,
                    'language_id' => $language_id,
                    'name' => $name
                ]
            );
        }

        return redirect(avenue_route('roles.index'))->with('success', 'Role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Languages::all()->keyBy('language_id');
        $role = Roles::findOrFail($id);

        return view('cms.roles.view', compact('role', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Roles::findOrFail($id);

        $reindexedLabels = [];
        foreach ($role->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $role->labels = $reindexedLabels;

        $languages = Languages::all()->keyBy('language_id');

        return view('cms.roles.create', compact('role', 'languages'));
    }
}
