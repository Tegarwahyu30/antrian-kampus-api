<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [

        'nama',

        'nim',

        'keperluan',

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