<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Contribution extends Model
{  
    use  HasFactory, Notifiable;
    // protected $table='contributions'
    protected $fillable=[
        'user_id',
        'amount',
        'note',
        'paid_at',
        'paid_method'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
