<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'code',
        'sort'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'type_id', 'id');
    }

    public function labels()
    {
        return $this->hasMany(TypeI18n::class, 'type_id', 'id');
    }

    public function label(): HasOne
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return $this->hasOne(TypeI18n::class, 'type_id', 'id')->where('language_id', $languageId);
    }

}
