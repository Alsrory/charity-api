<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscriber extends Model
{
    //
    protected $fillable=[
        'user_id',
        'subscribes_at',
        'status',
        

    ];
     protected $hidden = [
        'password',
        'remember_token',
    ];
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function subscriptions():HasMany{
        return $this->hasMany(Subscription::class);
    }
}
