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
        'start_date',
        'end_date',
        'note',
        'added_by',
        'updated_by'
    ];
    
    public function status()
    {
        return $this->belongsTo(Statuses::class);
    }

    public function type()
    {
        return $this->belongsTo(Types::class);
    }
}
