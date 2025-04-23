<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Device extends Model
{
    protected $connection = 'mongodb'; // Use the MongoDB connection

    protected $fillable = [
        'name',
        'type',
        'location',
        'status',
        'user_id',     // Owner of the device
        'data_logs'    // Optional: historical usage data
    ];
}

