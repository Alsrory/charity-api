<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = ['level', 'message', 'context'];

    protected $casts = [
        'context' => 'array',
    ];
}
// This model represents a system log entry, which can be used to store logs with different levels (e.g., emergency, error, info) and additional context in JSON format.
// The `context` field is cast to an array, allowing for easy manipulation of structured data.
// The `fillable` property specifies which attributes can be mass assigned, providing a way to create or update log entries conveniently.