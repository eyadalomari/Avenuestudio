<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $fillable = [
        'code',
        'sort'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'status_id', 'id');
    }

    public function labels()
    {
        return $this->hasMany(StatusI18n::class, 'status_id', 'id');
    }
}
