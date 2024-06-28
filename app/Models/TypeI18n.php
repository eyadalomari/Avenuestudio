<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeI18n extends Model
{
    use HasFactory;
    
    protected $table = 'types_i18n';

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
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
