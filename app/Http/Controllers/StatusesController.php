<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statuses;
use App\Models\StatusesLabel;
use App\Models\Languages;
use Illuminate\Validation\Rule;

class StatusesController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        $statuses = StatusesLabel::where('language_id', $language_id)->paginate(config('constants.PAGINATION'));
        
        return view('cms.statuses.index', compact('statuses', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Languages::all()->keyBy('language_id');
        return view('cms.statuses.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('statuses')->ignore($request->status_id, 'status_id')],
            'sort' => 'required|integer',
            'name.*' => 'required|string|max:50',
        ]);

        if ($request->has('status_id')) {
            $status = Statuses::find($request->get('status_id'));
            $status->update([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        } else {
            $status = Statuses::create([
                'code' => $request->get('code'),
                'sort' => $request->get('sort'),
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            StatusesLabel::updateOrCreate(
                [
                    'status_id' => $status->status_id,
                    'language_id' => $language_id,
                    'name' => $name
                ]
            );
        }

        return redirect(avenue_route('statuses.index'))->with('success', 'Role saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Languages::all()->keyBy('language_id');
        $status = Statuses::findOrFail($id);

        return view('cms.statuses.view', compact('status', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Statuses::findOrFail($id);

        $reindexedLabels = [];
        foreach ($status->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $status->labels = $reindexedLabels;

        $languages = Languages::all()->keyBy('language_id');

        return view('cms.statuses.create', compact('status', 'languages'));
    }
}
