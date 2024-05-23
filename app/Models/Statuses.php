<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    protected $primaryKey = 'status_id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'sort'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'status_id', 'status_id');
    }

    public function labels()
    {
        return $this->hasMany(StatusesLabel::class, 'status_id', 'status_id');
    }

    public function getStatuses($paginate = true)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
    
        $query = Statuses::leftJoin('statuses_labels', function($join) use ($language_id) {
            $join->on('statuses.status_id', '=', 'statuses_labels.status_id')
                 ->where('statuses_labels.language_id', '=', $language_id);
        })
        ->select('statuses.*', 'statuses_labels.*');
    
        return $paginate ? $query->paginate(10) : $query->get();
    }
}
