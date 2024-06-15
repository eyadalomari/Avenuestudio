<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public function getEndAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = Carbon::createFromFormat('H:i', $value)->format('H:i:s');
    }

    public static function list($filters = [])
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $query = Reservations::select('reservations.*', 'statuses_labels.name as status_name', 'types_labels.name as type_name');
        $query->join('statuses', 'reservations.status_id', '=', 'statuses.status_id');
        $query->join('statuses_labels', function ($join) use ($language_id) {
            $join->on('statuses.status_id', '=', 'statuses_labels.status_id')->where('statuses_labels.language_id', $language_id);
        });
        $query->join('types', 'reservations.type_id', '=', 'types.type_id');
        $query->join('types_labels', function ($join) use ($language_id) {
            $join->on('types.type_id', '=', 'types_labels.type_id')->where('types_labels.language_id', $language_id);
        });

        // Apply filters
        if (!empty($filters['keyword'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('reservations.name', 'like', '%' . $filters['keyword'] . '%')
                ->orWhere('reservations.reservation_id', $filters['keyword'])
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

        return $query->paginate(config('constants.PAGINATION'));
    }
}
