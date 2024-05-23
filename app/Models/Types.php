<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    protected $primaryKey = 'type_id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'sort'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservations::class, 'type_id', 'type_id');
    }

    public function labels()
    {
        return $this->hasMany(TypesLabel::class, 'type_id', 'type_id');
    }

    public function getTypes($paginate = true)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;

        $query = Types::leftJoin('types_labels', function ($join) use ($language_id) {
            $join->on('types.type_id', '=', 'types_labels.type_id')
                 ->where('types_labels.language_id', '=', $language_id);
        })
        ->select('types.*', 'types_labels.*');

        return $paginate ? $query->paginate(10) : $query->get();
    }
}
