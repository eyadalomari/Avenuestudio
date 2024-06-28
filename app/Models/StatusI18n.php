<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusI18n extends Model
{
    use HasFactory;

    protected $table = 'statuses_i18n';

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
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
