<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use App\Models\Language;
use App\Models\StatusI18n;

class StatusController extends Controller
{
    public function index()
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
        
        $statuses = Status::select('statuses.id', 'statuses.code', 'statuses.sort', 'statuses.created_at', 'statuses.updated_at', 'statuses_i18n.name')
        ->join('statuses_i18n', 'statuses.id', '=', 'statuses_i18n.status_id')
        ->where('statuses_i18n.language_id', $language_id)
        ->paginate(env('PER_PAGE', 12));
        return view('cms/statuses/index', compact('statuses', 'language_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all()->keyBy('id');
        return view('cms/statuses/create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusRequest $request)
    {
        if ($request->has('id')) {
            $status = Status::find($request->id);
            $status->update([
                'code' => $request->code,
                'sort' => $request->sort,
            ]);
        } else {
            $status = Status::create([
                'code' => $request->code,
                'sort' => $request->sort,
            ]);
        }

        foreach ($request->get('name') as $language_id => $name) {
            StatusI18n::updateOrCreate(
                [
                    'status_id' => $status->id,
                    'language_id' => $language_id,
                ],[
                    'name' => $name
                ]
            );
        }

        return redirect(avenue_route('statuses.index'))->with('success', 'Status saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');
        $status = Status::findOrFail($id);

        return view('cms/statuses/view', compact('status', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status = Status::findOrFail($id);

        $reindexedLabels = [];
        foreach ($status->labels->sortBy('language_id') as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $status->labels = $reindexedLabels;

        $languages = Language::all()->keyBy('id');

        return view('cms/statuses/create', compact('status', 'languages'));
    }
}
