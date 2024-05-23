<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Types;
use App\Models\TypesLabel;
use App\Models\Languages;
use Illuminate\Validation\Rule;

class TypesController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $types = (new Types())->getTypes();
        
        return view('CMS.types.index', compact('types', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Languages::all()->keyBy('language_id');
        return view('CMS.types.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('types')->ignore($request->type_id, 'type_id')],
            'sort' => 'required|integer',
            'name.*' => 'required|string|max:50',
        ]);

        if ($request->has('type_id')) {
            $type = Types::find($request->get('type_id'));
            $type->update([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        } else {
            $type = Types::create([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            TypesLabel::updateOrCreate(
                [
                    'type_id' => $type->type_id,
                    'language_id' => $language_id,
                    'name' => $name
                ]
            );
        }

        return redirect(avenue_route('types.index'))->with('success', 'Role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Languages::all()->keyBy('language_id');
        $type = Types::findOrFail($id);

        return view('CMS.types.view', compact('type', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Types::findOrFail($id);

        $reindexedLabels = [];
        foreach ($type->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $type->labels = $reindexedLabels;

        $languages = Languages::all()->keyBy('language_id');

        return view('CMS.types.create', compact('type', 'languages'));
    }
}
