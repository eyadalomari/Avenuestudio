<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function labels()
    {
        return $this->hasMany(RoleI18n::class, 'role_id', 'id');
    }
}
