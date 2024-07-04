<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Language;
use App\Repositories\TypeRepository;

class TypeController extends AdminController
{

    private $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
        parent::__construct();
        $this->typeRepository = $typeRepository;
    }

    public function index()
    {
        $types = $this->typeRepository->getAllTypes();

        return view('cms/types/index', compact('types'));
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
        $this->typeRepository->storeType();

        return redirect(avenue_route('types.index'))->with('success', 'Type saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $type = $this->typeRepository->getTypeById($id);

        return view('cms/types/view', compact('type', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = Language::all()->keyBy('id');

        $type = $this->typeRepository->getTypeById($id);

        return view('cms/types/create', compact('type', 'languages'));
    }
}
