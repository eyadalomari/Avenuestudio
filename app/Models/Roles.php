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

    public function reservations()
    {
        return $this->hasMany(User::class);
    }

    public function labels()
    {
        return $this->hasMany(RolesLabel::class, 'role_id', 'role_id');
    }
}
