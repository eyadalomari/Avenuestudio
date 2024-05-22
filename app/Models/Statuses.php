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
        return $this->hasMany(Reservations::class);
    }

    public function labels()
    {
        return $this->hasMany(StatusesLabel::class, 'status_id', 'status_id');
    }
}
