<?php

namespace App\Repositories;

use App\Models\Type;
use App\Models\TypeI18n;

class TypeRepository
{
    public function list()
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return Type::select('types.id', 'types.code', 'types.sort', 'types.created_at', 'types.updated_at', 'types_i18n.name')
            ->join('types_i18n', 'types.id', '=', 'types_i18n.type_id')
            ->where('types_i18n.language_id', $languageId)
            ->paginate(env('PER_PAGE', 12));
    }

    public function getAllByLanguage($languageId)
    {
        return TypeI18n::where('language_id', $languageId)->get();
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
        
        $reindexedLabels = [];
        foreach ($type->labels as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $type->labels = $reindexedLabels;

        return $type;
    }
}
