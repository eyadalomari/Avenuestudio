<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusesLabel extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'status_id',
        'language_id',
        'name'
    ];

    /**
     * Get the property type that owns the label.
     */
    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id', 'status_id');
    }
}
