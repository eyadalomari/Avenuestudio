<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class ReservationRepository
{
    public function list($filters = [], $withPaginate = true)
    {
        $query = Reservation::query()
        ->filterByKeyword($filters['keyword'] ?? null)
        ->filterByStatus($filters['status_id'] ?? null)
        ->filterByType($filters['type_id'] ?? null)
        ->filterByPhotographer($filters['photographer'] ?? null)
        ->filterByDateRange($filters['from_date'] ?? null, $filters['to_date'] ?? null)
        ->orderBy('reservations.date', 'DESC')
        ->orderBy('reservations.start', 'ASC');

        if($withPaginate){
            return $query->paginate(env('PER_PAGE', 12));
        }

        return $query->get();
    }

    public function store()
    {
        Reservation::updateOrCreate(
            [
                'id' => request()->id
            ],
            [
                'name' => request()->name,
                'mobile' => request()->mobile,
                'type_id' => request()->type_id,
                'location_type' => request()->location_type,
                'price' => request()->price,
                'price_remaining' => request()->price_remaining,
                'photographer' => request()->photographer,
                'status_id' => request()->status_id,
                'has_video' => request()->has_video,
                'date' => request()->date,
                'start' => request()->start,
                'end' => request()->end,
                'note' => request()->note,
                'updated_by' => Auth::user()->id,
            ]
        );
    }

    public function isTimeOverlap()
    {
        $query = Reservation::where('date', request()->date)->where(function ($query) {
            $query->where(function ($query) {
                $query->where('start', '<=', request()->start)
                    ->where('end', '>', request()->start);
            })->orWhere(function ($query) {
                $query->where('start', '<', request()->end)
                    ->where('end', '>=', request()->end);
            })->orWhere(function ($query) {
                $query->where('start', '>=', request()->start)
                    ->where('end', '<=', request()->end);
            });
        });

        $active_status = Status::where('code', 'active')->firstOrFail()->id;
        $query->where('status_id', '=', $active_status);

        if (isset(request()->id)) {
            $query->where('id', '!=', request()->id);
        }

        return $query->first();
    }

    public function findById($reservation_id)
    {
        return Reservation::findOrFail($reservation_id);
    }
}
