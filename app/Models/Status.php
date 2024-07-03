<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function label(): HasOne
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return $this->hasOne(StatusI18n::class, 'status_id', 'id')->where('language_id', $languageId);
        
    }

    public function labels()
    {
        return $this->hasMany(StatusI18n::class, 'status_id', 'id');
    }
}
