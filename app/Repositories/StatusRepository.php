<?php

namespace App\Repositories;

use App\Models\Status;
use App\Models\StatusI18n;

class StatusRepository
{
    public function getAllStatuses($withPaginate = true)
    {
        if($withPaginate){
            return Status::paginate(env('PER_PAGE', 12));
        }
        
        return Status::all();
    }
    
    public function storeStatus()
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

    public function getStatusById($status_id)
    {
        $status = Status::findOrFail($status_id);
        $status->labels = $status->labels->keyBy('language_id');

        return $status;
    }

    public function getStatusBycode($code)
    {
        $status = Status::where('code', $code)->firstOrFail();
        $status->labels = $status->labels->keyBy('language_id');
        
        return $status;
    }
}
