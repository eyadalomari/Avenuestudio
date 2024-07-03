<?php

namespace App\Repositories;

use App\Models\Type;
use App\Models\TypeI18n;

class TypeRepository
{
    public function list()
    {
        return Type::paginate(env('PER_PAGE', 12));
    }

    public function getAllTypes()
    {
        return Type::all();
    }

    public function store()
    {
        $type = Type::updateOrCreate(
            [
                'id' => request()->id
            ],
            [
                'code' => request()->code,
                'sort' => request()->sort,
            ]
        );


        foreach (request()->name as $languageId => $name) {
            TypeI18n::updateOrCreate(
                [
                    'type_id' => $type->id,
                    'language_id' => $languageId,
                ],
                [
                    'name' => $name
                ]
            );
        }
    }

    public function findById($type_id)
    {
        $type = Type::findOrFail($type_id);
        $type->labels = $type->labels->keyBy('language_id');
        
        return $type;
    }
}
