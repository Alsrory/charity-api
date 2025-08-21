<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    //
    protected $fillable=[
        'subscriber_id',
        'amount',
        'month',
        'payment_method',
        'status',
        'paid_at'
    ];
    public function subscriber():BelongsTo{
        return $this->belongsTo(Subscriber::class);
    }
}
