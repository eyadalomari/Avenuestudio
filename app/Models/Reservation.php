<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

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
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function thePhotographer()
    {
        return $this->belongsTo(User::class, 'photographer', 'id');
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

        $query = Reservation::select('reservations.*', 'statuses_i18n.name as status_name', 'types_i18n.name as type_name');
        $query->join('statuses', 'reservations.status_id', '=', 'statuses.id');
        $query->join('statuses_i18n', function ($join) use ($language_id) {
            $join->on('statuses.id', '=', 'statuses_i18n.status_id')->where('statuses_i18n.language_id', $language_id);
        });
        $query->join('types', 'reservations.type_id', '=', 'types.id');
        $query->join('types_i18n', function ($join) use ($language_id) {
            $join->on('types.id', '=', 'types_i18n.type_id')->where('types_i18n.language_id', $language_id);
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

        return $query->paginate(config('constants.PAGINATION'));
    }
}
