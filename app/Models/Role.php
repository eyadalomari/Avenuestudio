<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'code',
        'sort'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_id', 'id');
    }

    public function label(): HasOne
    {
        $languageId = app()->getLocale() == 'en' ? 1 : 2;

        return $this->hasOne(RoleI18n::class, 'role_id', 'id')->where('language_id', $languageId);
    }

    public function labels()
    {
        return $this->hasMany(RoleI18n::class, 'role_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
