<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Language;
use App\Repositories\StatusRepository;

class StatusController extends AdminController
{
    private $statusRepository;

    public function __construct(StatusRepository $statusRepository)
    {
        parent::__construct();
        $this->statusRepository = $statusRepository;
    }
    
    public function index()
    {
        $statuses = $this->statusRepository->getAllStatuses();
     
        return view('cms/statuses/index', compact('statuses'));
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
        $this->statusRepository->storeStatus();

        return redirect(avenue_route('statuses.index'))->with('success', 'Status saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $status = $this->statusRepository->getStatusById($id);

        return view('cms/statuses/view', compact('status', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all()->keyBy('id');
        $status = $this->statusRepository->getStatusById($id);

        return view('cms/statuses/create', compact('status', 'languages'));
    }
}
