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
}
