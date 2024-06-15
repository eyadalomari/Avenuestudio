<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesLabel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'type_id',
        'language_id',
        'name'
    ];

    /**
     * Get the property type that owns the label.
     */
    public function type()
    {
        return $this->belongsTo(Types::class, 'type_id', 'type_id');
    }
}
