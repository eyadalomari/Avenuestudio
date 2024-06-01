<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'sort'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_id', 'role_id');
    }

    public function labels()
    {
        return $this->hasMany(RolesLabel::class, 'role_id', 'role_id');
    }
}
