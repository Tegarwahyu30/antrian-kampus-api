<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'queue_number',
        'queue_date',
        'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}