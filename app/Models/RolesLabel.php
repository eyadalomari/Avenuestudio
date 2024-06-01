<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesLabel extends Model
{
    use HasFactory;

    protected $table = 'roles_labels';

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
        return $this->belongsTo(Roles::class, 'role_id', 'role_id');
    }
}
