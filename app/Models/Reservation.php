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

    /* ==================================================================
   ||                         FILTERS SECTION                          ||
   =================================================================== */


    public function scopeFilterByKeyword($query, $keyword)
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('reservations.name', 'like', '%' . $keyword . '%')
                    ->orWhere('reservations.id', $keyword)
                    ->orWhere('reservations.mobile', 'like', '%' . $keyword . '%');
            });
        }

        return $query;
    }

    public function scopeFilterByStatus($query, $statusId)
    {
        if ($statusId) {
            $query->where('reservations.status_id', $statusId);
        }

        return $query;
    }

    public function scopeFilterByType($query, $typeId)
    {
        if ($typeId) {
            $query->where('reservations.type_id', $typeId);
        }

        return $query;
    }

    public function scopeFilterByPhotographer($query, $photographer)
    {
        if ($photographer) {
            $query->where('reservations.photographer', $photographer);
        }

        return $query;
    }

    public function scopeFilterByDateRange($query, $fromDate, $toDate)
    {
        if ($fromDate) {
            $query->whereDate('reservations.date', '>=', $fromDate);
        }

        if ($toDate) {
            $query->whereDate('reservations.date', '<=', $toDate);
        }

        return $query;
    }
}
