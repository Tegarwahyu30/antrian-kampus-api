<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
    'service_code',
    'service_name',
    'description',
    'status'
];
}