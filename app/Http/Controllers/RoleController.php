<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleI18n;
use App\Models\Language;
use Illuminate\Validation\Rule;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $roles = RoleI18n::where('language_id', $language_id)->paginate(config('constants.PAGINATION'));
        $roles = Role::select('roles.id', 'roles.code', 'roles.sort', 'roles.created_at', 'roles.updated_at', 'roles_i18n.name')
        ->join('roles_i18n', 'roles.id', '=', 'roles_i18n.role_id')
        ->where('roles_i18n.language_id', $language_id)
        ->paginate(10);
        return view('cms/roles/index', compact('roles', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all()->keyBy('id');
        return view('cms/roles/create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('roles')->ignore($request->id)],
            'sort' => 'required|integer',
            'name.*' => 'required|string|max:50',
        ]);

        if ($request->has('id')) {
            $role = Role::find($request->id);
            $role->update([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        } else {
            $role = Role::create([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            RoleI18n::updateOrCreate(
                [
                    'role_id' => $role->id,
                    'language_id' => $language_id,
                ],[
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
        $languages = Language::all()->keyBy('id');
        $role = Role::findOrFail($id);

        return view('cms/roles/view', compact('role', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        $reindexedLabels = [];
        foreach ($role->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $role->labels = $reindexedLabels;

        $languages = Language::all()->keyBy('id');

        return view('cms/roles/create', compact('role', 'languages'));
    }
}
