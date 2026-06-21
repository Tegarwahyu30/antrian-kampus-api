<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class Antrian extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'keperluan',
        'service_id',
        'queue_number',
        'queue_date',
        'status',
    ];

    // RELASI KE LAYANAN
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}