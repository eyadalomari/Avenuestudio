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

    public function labels()
    {
        return $this->hasMany(RolesLabel::class, 'role_id', 'role_id');
    }

    public function getRoles($paginate = true)
    {
        $language_id = app()->getLocale() == 'en' ? 1 : 2;
    
        $query = Roles::leftJoin('roles_labels', function($join) use ($language_id) {
            $join->on('roles.role_id', '=', 'roles_labels.role_id')
                 ->where('roles_labels.language_id', '=', $language_id);
        })
        ->select('roles.*', 'roles_labels.*');
    
        return $paginate ? $query->paginate(10) : $query->get();
    }
    
}
