<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class ReservationRepository
{
    public function list($filters = [])
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $query = Reservation::select('reservations.*', 'statuses_i18n.name as status_name', 'types_i18n.name as type_name');
        $query->join('statuses', 'reservations.status_id', '=', 'statuses.id');
        $query->join('statuses_i18n', function ($join) use ($languageId) {
            $join->on('statuses.id', '=', 'statuses_i18n.status_id')->where('statuses_i18n.language_id', $languageId);
        });
        $query->join('types', 'reservations.type_id', '=', 'types.id');
        $query->join('types_i18n', function ($join) use ($languageId) {
            $join->on('types.id', '=', 'types_i18n.type_id')->where('types_i18n.language_id', $languageId);
        });

        // Apply filters
        if (!empty($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('reservations.name', 'like', '%' . $filters['keyword'] . '%')
                    ->orWhere('reservations.id', $filters['keyword'])
                    ->orWhere('reservations.mobile', 'like', '%' . $filters['keyword'] . '%');
            });
        }

        if (!empty($filters['status_id'])) {
            $query->where('reservations.status_id', $filters['status_id']);
        }

        if (!empty($filters['type_id'])) {
            $query->where('reservations.type_id', $filters['type_id']);
        }

        if (!empty($filters['photographer'])) {
            $query->where('reservations.photographer', $filters['photographer']);
        }

        if (!empty($filters['from_date'])) {
            $query->whereDate('reservations.date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $query->whereDate('reservations.date', '<=', $filters['to_date']);
        }

        $query->orderBy('reservations.date', 'DESC');

        return $query->paginate(env('PER_PAGE', 12));
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
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        $reservation = Reservation::findOrFail($reservation_id);

        foreach ($reservation->status->labels as $row) {
            if ($row->language_id == $languageId) {
                $reservation->status_name = $row->name;
            }
        }

        foreach ($reservation->type->labels as $row) {
            if ($row->language_id == $languageId) {
                $reservation->type_name = $row->name;
            }
        }
        
        return $reservation;
    }
}
