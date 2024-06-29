<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use App\Models\Language;
use App\Models\TypeI18n;

class TypeController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $types = Type::select('types.id', 'types.code', 'types.sort', 'types.created_at', 'types.updated_at', 'types_i18n.name')
        ->join('types_i18n', 'types.id', '=', 'types_i18n.type_id')
        ->where('types_i18n.language_id', $language_id)
        ->paginate(env('PER_PAGE', 12));

        return view('cms/types/index', compact('types', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all()->keyBy('id');
        return view('cms/types/create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        if ($request->has('id')) {
            $type = Type::find($request->id);
            $type->update([
                'code' => $request->code,
                'sort' => $request->sort,
            ]);
        } else {
            $type = Type::create([
                'code' => $request->code,
                'sort' => $request->sort,
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            TypeI18n::updateOrCreate(
                [
                    'type_id' => $type->id,
                    'language_id' => $language_id,
                ],[
                    'name' => $name
                ]
            );
        }

        return redirect(avenue_route('types.index'))->with('success', 'Type saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');
        $type = Type::findOrFail($id);

        return view('cms/types/view', compact('type', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);

        $reindexedLabels = [];
        foreach ($type->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $type->labels = $reindexedLabels;

        $languages = Language::all()->keyBy('id');

        return view('cms/types/create', compact('type', 'languages'));
    }
}
