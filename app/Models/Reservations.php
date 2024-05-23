<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'name',
        'mobile',
        'type_id',
        'location_type',
        'price',
        'price_remaining',
        'photographer',
        'status_id',
        'has_video',
        'date',
        'start',
        'end',
        'note',
        'added_by',
        'updated_by'
    ];

    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id', 'status_id');
    }

    public function type()
    {
        return $this->belongsTo(Types::class, 'type_id', 'type_id');
    }

    public function thePhotographer()
    {
        return $this->belongsTo(User::class, 'photographer', 'user_id');
    }

    public function getStartAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public function getEndAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = \Carbon\Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public function getReservations($paginate = true)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $query = Reservations::select(
            'reservations.*',
            'statuses_labels.name as status_name',
            'types_labels.name as type_name'
        )
            ->join('statuses', 'reservations.status_id', '=', 'statuses.status_id')
            ->join('statuses_labels', function ($join) use ($language_id) {
                $join->on('statuses.status_id', '=', 'statuses_labels.status_id')->where('statuses_labels.language_id', $language_id);
            })->join('types', 'reservations.type_id', '=', 'types.type_id')
            ->join('types_labels', function ($join) use ($language_id) {
                $join->on('types.type_id', '=', 'types_labels.type_id')->where('types_labels.language_id', $language_id);
            });

        return $paginate ? $query->paginate(10) : $query->get();
    }
}
