<?php

namespace App\Repositories;

use App\Models\Status;
use App\Models\StatusI18n;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StatusRepository
{
    public function list()
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return Status::select('statuses.id', 'statuses.code', 'statuses.sort', 'statuses.created_at', 'statuses.updated_at', 'statuses_i18n.name')
            ->join('statuses_i18n', 'statuses.id', '=', 'statuses_i18n.status_id')
            ->where('statuses_i18n.language_id', $languageId)
            ->paginate(env('PER_PAGE', 12));
    }

    public function getAllByLanguage($languageId)
    {
        return StatusI18n::where('language_id', $languageId)->get();
    }

    public function store()
    {
        $status = Status::updateOrCreate(
            [
                'id' => request()->id
            ],
            [
                'code' => request()->code,
                'sort' => request()->sort,
            ]
        );


        foreach (request()->name as $languageId => $name) {
            StatusI18n::updateOrCreate(
                [
                    'status_id' => $status->id,
                    'language_id' => $languageId,
                ],
                [
                    'name' => $name
                ]
            );
        }
    }

    public function findById($status_id)
    {
        $status = Status::findOrFail($status_id);
        
        $reindexedLabels = [];
        foreach ($status->labels as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $status->labels = $reindexedLabels;

        return $status;
    }

    public function findBycode($code)
    {
        $status = Status::where('code', $code)->firstOrFail();
        
        $reindexedLabels = [];
        foreach ($status->labels as $label) {
            $reindexedLabels[$label->language_id] = $label;
        }
        $status->labels = $reindexedLabels;

        return $status;
    }
}
