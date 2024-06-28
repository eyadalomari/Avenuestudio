<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleI18n extends Model
{
    use HasFactory;

    protected $table = 'roles_i18n';

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'role_id',
        'language_id',
        'name'
    ];

    /**
     * Get the property type that owns the label.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
