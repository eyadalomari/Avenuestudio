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
}
